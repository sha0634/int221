<!-- Floating Chatbot Widget -->
<div id="foliobot-widget" style="position: fixed; bottom: 2rem; right: 2rem; z-index: 9999; font-family: 'Inter', sans-serif;">
    
    <!-- Chat Toggle Trigger Button -->
    <button id="foliobot-trigger" style="width: 60px; height: 60px; border-radius: 30px; background: linear-gradient(135deg, #111827 0%, #374151 100%); border: none; box-shadow: 0 8px 30px rgba(0,0,0,0.15); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: white; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); outline: none;">
        🤖
    </button>

    <!-- Chat Card Window -->
    <div id="foliobot-window" style="display: none; width: 360px; height: 500px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(229, 231, 235, 0.8); border-radius: 24px; box-shadow: 0 12px 40px rgba(0,0,0,0.12); flex-direction: column; overflow: hidden; position: absolute; bottom: 80px; right: 0; transition: all 0.3s ease;">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #111827 0%, #1F2937 100%); padding: 1.25rem; display: flex; align-items: center; justify-content: space-between; color: white;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    🤖
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 0.95rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                        FolioBot
                        <span style="width: 8px; height: 8px; background: #10B981; border-radius: 50%; display: inline-block; animation: pulse 2s infinite;"></span>
                    </h4>
                    <span style="font-size: 0.7rem; color: #9CA3AF; font-weight: 500;">AI Platform Guide</span>
                </div>
            </div>
            <button id="foliobot-close" style="background: none; border: none; color: #9CA3AF; font-size: 1.25rem; cursor: pointer; padding: 0.25rem; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#9CA3AF'">
                ✕
            </button>
        </div>

        <!-- Messages Area -->
        <div id="foliobot-messages" style="flex: 1; padding: 1.25rem; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; background: #FAF9F6;">
            <!-- Welcome message -->
            <div class="bot-msg-wrapper" style="display: flex; gap: 0.5rem; max-width: 85%;">
                <div style="font-size: 1.2rem;">🤖</div>
                <div style="background: white; border: 1px solid #E5E7EB; color: #1F2937; padding: 0.75rem 1rem; border-radius: 16px 16px 16px 4px; font-size: 0.85rem; line-height: 1.4; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    Hi! I'm FolioBot, your personal platform concierge. How can I help you today?
                </div>
            </div>
        </div>

        <!-- Suggestions Panel -->
        <div id="foliobot-suggestions" style="padding: 0.75rem 1.25rem; background: white; border-top: 1px solid #F3F4F6; display: flex; flex-wrap: wrap; gap: 0.4rem; max-height: 120px; overflow-y: auto;">
            <button class="bot-pill" onclick="sendSuggestion('How to send an automated email?')" style="background: #FEE2E2; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; color: #991B1B; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#FCA5A5'" onmouseout="this.style.background='#FEE2E2'">
                📧 Automated Email
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How to reset my password?')" style="background: #FEF3C7; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; color: #92400E; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#FCD34D'" onmouseout="this.style.background='#FEF3C7'">
                🔑 Reset Password
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How to export my data?')" style="background: #D1FAE5; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; color: #065F46; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#6EE7B7'" onmouseout="this.style.background='#D1FAE5'">
                📁 Export Data
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How to collaborate with creators?')" style="background: #F3F4F6; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #4B5563; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">
                ✉️ Collaborations
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How is payment secured?')" style="background: #F3F4F6; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #4B5563; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">
                💳 Safe Payments
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How do I customize my page?')" style="background: #F3F4F6; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #4B5563; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">
                🎨 Customize Portfolio
            </button>
            <button class="bot-pill" onclick="sendSuggestion('How to moderate users?')" style="background: #F3F4F6; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #4B5563; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">
                🛡️ Moderating Users
            </button>
            <button class="bot-pill" onclick="sendSuggestion('Contact support')" style="background: #F3F4F6; border: none; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #4B5563; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">
                📞 Support Line
            </button>
        </div>

        <!-- Input Box -->
        <div style="padding: 0.75rem 1.25rem; background: white; border-top: 1px solid #E5E7EB; display: flex; gap: 0.5rem; align-items: center;">
            <input type="text" id="foliobot-input" placeholder="Type a message..." style="flex: 1; border: 1px solid #E5E7EB; padding: 0.65rem 1rem; border-radius: 12px; font-size: 0.85rem; outline: none; transition: border 0.2s;" onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#E5E7EB'">
            <button id="foliobot-send" style="width: 36px; height: 36px; border-radius: 10px; background: #111827; border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#374151'" onmouseout="this.style.background='#111827'">
                ➤
            </button>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.getElementById('foliobot-trigger');
    const windowEl = document.getElementById('foliobot-window');
    const closeBtn = document.getElementById('foliobot-close');
    const sendBtn = document.getElementById('foliobot-send');
    const inputEl = document.getElementById('foliobot-input');
    const messagesEl = document.getElementById('foliobot-messages');

    // Toggle window visibility
    trigger.addEventListener('click', function() {
        if (windowEl.style.display === 'none' || windowEl.style.display === '') {
            windowEl.style.display = 'flex';
            trigger.style.transform = 'rotate(360deg) scale(0.9)';
            inputEl.focus();
        } else {
            closeWindow();
        }
    });

    closeBtn.addEventListener('click', closeWindow);

    function closeWindow() {
        windowEl.style.display = 'none';
        trigger.style.transform = 'rotate(0deg) scale(1)';
    }

    // Static Rules Database
    const botRules = [
        {
            keys: ['email', 'mail', 'automated email', 'send email', 'notification', 'notifications'],
            response: "To send an automated email on our platform, you can configure automatic notifications. In Laravel, this is handled via Mailables or Notifications. Go to the Settings page to toggle automated email notifications for new inquiries, paid invoices, or contract signature events!"
        },
        {
            keys: ['password', 'reset password', 'forgot password', 'credential', 'login details'],
            response: "To reset your password, log out of your current account, go to the Login screen, click the 'Forgot Password' link, and enter your email address. We will send you a secure password reset link to create a new credential."
        },
        {
            keys: ['export', 'csv', 'download data', 'export data', 'excel', 'report'],
            response: "To export your portfolio traffic or billing ledger, click the 'Export CSV' button located at the top right of your Analytics and Invoices tables. This will generate a clean download containing all your filtered database logs."
        },
        {
            keys: ['collaborate', 'message', 'contact', 'hire', 'creator', 'collaboration'],
            response: "To collaborate with a creator, go to the <b>Discover Talent Network</b>, select a creator, and click the 'Collaborate' button. You can send them a direct message, and once they reply, you can sign a contract and settle invoices directly from your Billing tab!"
        },
        {
            keys: ['pay', 'payment', 'invoice', 'billing', 'escrow', 'money', 'settle'],
            response: "Payments are processed securely via our built-in Invoice & Escrow Ledger. Once a creator completes a milestone, they generate an invoice which you can settle in one click under your Billing & Payments workspace."
        },
        {
            keys: ['search', 'niche', 'filter', 'keyword', 'domain', 'find', 'category'],
            response: "Absolutely! Use the top search bar or click on the domain filter pills (like Interior Design, Modern, Creative) to instantly filter portfolios matching that exact specialty."
        },
        {
            keys: ['edit', 'customize', 'portfolio', 'template', 'theme', 'change', 'design'],
            response: "Go to the <b>Portfolio</b> tab in your sidebar, choose a design style (Emma Holistic, Boutique, Minimalist), and click 'Setup'. This loads our high-fidelity, drag-and-click editor where you can customize all content in real-time!"
        },
        {
            keys: ['suspend', 'moderate', 'block', 'user', 'activate', 'is_suspended'],
            response: "Go to the <b>Users Directory</b> in the Admin dashboard, locate the user profile, and click the 'Suspend 🚫' button. The user will be instantly logged out and blocked from logging back in until you click 'Re-activate ✅'."
        },
        {
            keys: ['help', 'options', 'suggest', 'what can you do'],
            response: "I can help you with collaboration tips, payment security details, portfolio customization guides, or admin moderation workflows. Try clicking any of the quick suggestions below!"
        },
        {
            keys: ['support', 'contact support', 'human', 'email', 'problem', 'issue'],
            response: "Need human assistance? Email our team at <b>support@folio.com</b> or drop a line in our community Discord. We are happy to help!"
        }
    ];

    const defaultResponse = "I'm sorry, I didn't quite catch that. Try choosing one of the quick suggestions below or type 'help'!";

    // Send logic
    function handleUserSend() {
        const text = inputEl.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        inputEl.value = '';

        // Process Bot response after a small delay for ultra-premium human feel
        setTimeout(function() {
            const botResponse = findBotResponse(text);
            appendMessage(botResponse, 'bot');
        }, 600);
    }

    sendBtn.addEventListener('click', handleUserSend);
    inputEl.addEventListener('keypress', function(e) {
        if (e.key === 'enter' || e.keyCode === 13) {
            handleUserSend();
        }
    });

    // Make suggestion clickable
    window.sendSuggestion = function(text) {
        appendMessage(text, 'user');
        
        setTimeout(function() {
            const botResponse = findBotResponse(text);
            appendMessage(botResponse, 'bot');
        }, 600);
    };

    function appendMessage(text, sender) {
        const wrapper = document.createElement('div');
        wrapper.style.display = 'flex';
        wrapper.style.gap = '0.5rem';
        wrapper.style.maxWidth = '85%';
        
        if (sender === 'user') {
            wrapper.style.alignSelf = 'flex-end';
            wrapper.style.flexDirection = 'row-reverse';
            wrapper.innerHTML = `
                <div style="font-size: 1.2rem;">👤</div>
                <div style="background: #111827; border: 1px solid #111827; color: white; padding: 0.75rem 1rem; border-radius: 16px 16px 4px 16px; font-size: 0.85rem; line-height: 1.4; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    ${text}
                </div>
            `;
        } else {
            wrapper.style.alignSelf = 'flex-start';
            wrapper.innerHTML = `
                <div style="font-size: 1.2rem;">🤖</div>
                <div style="background: white; border: 1px solid #E5E7EB; color: #1F2937; padding: 0.75rem 1rem; border-radius: 16px 16px 16px 4px; font-size: 0.85rem; line-height: 1.4; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    ${text}
                </div>
            `;
        }

        messagesEl.appendChild(wrapper);
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function findBotResponse(text) {
        const cleanText = text.toLowerCase();
        
        for (const rule of botRules) {
            for (const key of rule.keys) {
                if (cleanText.includes(key)) {
                    return rule.response;
                }
            }
        }
        
        return defaultResponse;
    }
});
</script>
