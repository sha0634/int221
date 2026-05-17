<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\Inquiry;
use App\Models\PortfolioView;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed keywords for existing portfolios based on their template_name
        foreach (Portfolio::all() as $portfolio) {
            if (empty($portfolio->keywords)) {
                if ($portfolio->template_name === 'modern') {
                    $portfolio->update(['keywords' => ['holistic', 'wellness', 'lifestyle', 'beauty', 'mindfulness']]);
                } elseif ($portfolio->template_name === 'minimal') {
                    $portfolio->update(['keywords' => ['minimalist', 'architect', 'spaces', 'blueprint', 'exterior']]);
                } elseif ($portfolio->template_name === 'developer') {
                    $portfolio->update(['keywords' => ['boutique', 'interior', 'luxury', 'kitchen', 'furniture']]);
                } else {
                    $portfolio->update(['keywords' => ['design', 'development', 'creative']]);
                }
            }
        }

        // Ensure some test inquiries exist for any active portfolios
        foreach (Portfolio::all() as $portfolio) {
            // Seed inquiries
            if ($portfolio->inquiries()->count() === 0) {
                $portfolio->inquiries()->create([
                    'client_name' => 'Sarah Jenkins',
                    'client_email' => 'sarah@jenkinsbrands.co',
                    'subject' => 'Branding & UI Redesign Project',
                    'message' => "Hey there! We absolutely loved your creative portfolio and would love to hire you for our upcoming brand relaunch.\n\nAre you available for a freelance contract starting next month?",
                    'status' => 'new',
                ]);

                $portfolio->inquiries()->create([
                    'client_name' => 'Marcus Vance',
                    'client_email' => 'marcus@vancetech.io',
                    'subject' => 'Web App Development Contract',
                    'message' => "Hello,\n\nI came across your developer portfolio. We are looking for a skilled Laravel developer to help us build out a new SaaS dashboard feature. Let me know your rates and availability!",
                    'status' => 'new',
                ]);
            }

            // Seed 14 days of realistic traffic view counts
            if ($portfolio->views()->count() === 0) {
                $devices = [
                    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', // Desktop
                    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Safari/605.1.15', // Desktop
                    'Mozilla/5.0 (iPhone; CPU iPhone OS 17_2_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Mobile/15E148 Safari/604.1', // Mobile
                    'Mozilla/5.0 (iPad; CPU OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/120.0.6099.119 Mobile/15E148 Safari/604.1', // Tablet
                    'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', // Mobile
                ];

                for ($day = 14; $day >= 0; $day--) {
                    // Number of views per day ranges realistically between 8 and 35
                    $viewsCount = rand(8, 35);
                    $targetDate = now()->subDays($day);

                    for ($v = 0; $v < $viewsCount; $v++) {
                        $portfolio->views()->create([
                            'ip_address' => '192.168.1.' . rand(2, 254),
                            'user_agent' => $devices[array_rand($devices)],
                            'created_at' => $targetDate->copy()->subHours(rand(1, 23))->subMinutes(rand(1, 59)),
                        ]);
                    }
                }
            }

            // Seed contracts & invoices
            if (\App\Models\Contract::where('portfolio_id', $portfolio->id)->count() === 0) {
                // 1. Active signed contract
                $c1 = \App\Models\Contract::create([
                    'client_email' => 'sarah@jenkinsbrands.co',
                    'portfolio_id' => $portfolio->id,
                    'title' => 'Premium Brand Identity & Strategy Package',
                    'description' => 'Comprehensive branding, logo designs, tone of voice guidelines, and corporate stationery design assets.',
                    'amount' => 4500.00,
                    'status' => 'active',
                    'signed_at' => now()->subDays(5),
                ]);

                // 2. Pending contract
                \App\Models\Contract::create([
                    'client_email' => 'sarah@jenkinsbrands.co',
                    'portfolio_id' => $portfolio->id,
                    'title' => 'UX/UI Redesign Retainer Contract',
                    'description' => 'Recurring professional design retainer for ongoing monthly platform optimizations and high-fidelity mockups.',
                    'amount' => 2500.00,
                    'status' => 'pending',
                ]);

                // 3. Paid invoice linked to c1
                \App\Models\Invoice::create([
                    'contract_id' => $c1->id,
                    'client_email' => 'sarah@jenkinsbrands.co',
                    'portfolio_id' => $portfolio->id,
                    'title' => 'Brand Identity Deposit Invoice (50%)',
                    'amount' => 2250.00,
                    'due_date' => now()->subDays(5),
                    'status' => 'paid',
                    'paid_at' => now()->subDays(5),
                ]);

                // 4. Unpaid invoice linked to c1
                \App\Models\Invoice::create([
                    'contract_id' => $c1->id,
                    'client_email' => 'sarah@jenkinsbrands.co',
                    'portfolio_id' => $portfolio->id,
                    'title' => 'Brand Identity Final Deliverables Invoice (50%)',
                    'amount' => 2250.00,
                    'due_date' => now()->addDays(15),
                    'status' => 'unpaid',
                ]);
            }
        }
    }
}
