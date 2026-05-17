<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Editor - Folio</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Floating Editor Toolbar Styles */
        .editor-toolbar {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            z-index: 99999;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .editor-toolbar:hover {
            background: rgba(15, 23, 42, 0.99);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }

        .editor-btn {
            background: none;
            border: none;
            color: #94A3B8;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .editor-btn:hover {
            color: white;
            background: rgba(255, 255, 255, 0.08);
        }

        .editor-btn.primary {
            background: #4F46E5;
            color: white;
        }

        .editor-btn.primary:hover {
            background: #4338CA;
        }

        /* Color Scheme Selectors */
        .color-circles {
            display: flex;
            gap: 0.5rem;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            padding-left: 1.5rem;
        }

        .color-circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.2s;
        }

        .color-circle:hover {
            transform: scale(1.15);
        }

        .color-circle.active {
            border-color: white;
            box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.95) inset;
        }

        /* Outline highlighting for editable elements during edit mode */
        [contenteditable="true"] {
            outline: 2px dashed transparent;
            border-radius: 4px;
            transition: all 0.2s;
        }

        [contenteditable="true"]:hover {
            outline-color: #4F46E5;
            background: rgba(79, 70, 229, 0.05);
            cursor: text;
        }

        [contenteditable="true"]:focus {
            outline: 2px solid #4F46E5;
            background: transparent;
        }

        /* Image Editable Styling */
        .img-editable-container {
            position: relative;
            cursor: pointer;
            display: inline-block;
        }

        .img-editable-container:hover::before {
            content: 'Click to upload image';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: inherit;
            z-index: 10;
            backdrop-filter: blur(2px);
        }

        /* Hidden image input */
        .hidden-file-input {
            display: none;
        }

        /* Instructions overlay badge */
        .editor-hint {
            position: fixed;
            top: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.9);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 99999;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">

    <div class="editor-hint">
        <svg width="16" height="16" fill="none" stroke="#4F46E5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        Interactive Visual Mode — Click directly on any text or image to customize!
    </div>

    <!-- Hidden global file input for uploading images -->
    <input type="file" id="global-image-uploader" class="hidden-file-input" accept="image/*">

    <!-- Render actual portfolio template inline, marked as editing mode -->
    <div id="portfolio-container">
        @include('portfolios.' . $portfolio->template_name, ['portfolio' => $portfolio, 'isEditing' => true])
    </div>

    <!-- The Floating Editor controls toolbar -->
    <div class="editor-toolbar">
        <button class="editor-btn" id="btn-back">
            &larr; Exit
        </button>

        <button class="editor-btn" id="btn-add-project">
            + Add Project
        </button>

        <!-- Custom Editable URL Slug input -->
        <div style="display: flex; align-items: center; gap: 0.25rem; background: rgba(255, 255, 255, 0.08); padding: 0.5rem 0.8rem; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.1);">
            <span style="color: #94A3B8; font-size: 0.85rem; font-weight: 500;">/portfolio/</span>
            <input type="text" id="txt-slug" style="background: none; border: none; color: white; font-weight: 600; font-size: 0.85rem; width: 110px; padding: 0; outline: none;" value="{{ $portfolio->slug }}" placeholder="slug">
        </div>

        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <label style="font-size: 0.8rem; font-weight: 600; color: #94A3B8;">Status:</label>
            <label style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; font-weight: 600; cursor: pointer;" title="Publish to live URL">
                <input type="checkbox" id="chk-live" style="width: 16px; height: 16px; accent-color: #4F46E5;" {{ $portfolio->is_live ? 'checked' : '' }}>
                Live
            </label>
        </div>

        <div class="color-circles">
            @php
                $colors = [
                    'modern' => ['default' => '#111827', 'blue' => '#2563EB', 'green' => '#059669'],
                    'minimal' => ['default' => '#000000', 'gray' => '#4B5563', 'sand' => '#D5BDAF'],
                    'developer' => ['default' => '#1E1E1E', 'dracula' => '#282A36', 'monokai' => '#272822'],
                    'creative' => ['default' => '#EC4899', 'orange' => '#F97316', 'purple' => '#8B5CF6'],
                    'dark' => ['default' => '#121212', 'neon-green' => '#39FF14', 'neon-blue' => '#00FFFF']
                ];
                $templateColors = $colors[$portfolio->template_name] ?? $colors['modern'];
            @endphp
            @foreach($templateColors as $name => $hex)
                <div class="color-circle {{ $portfolio->theme_color == $name ? 'active' : '' }}" style="background-color: {{ $hex }};" data-color="{{ $name }}" title="{{ ucfirst($name) }}"></div>
            @endforeach
        </div>

        <button class="editor-btn primary" id="btn-save">
            Save changes
        </button>
    </div>

    <!-- Core Interactive Visual Editor Engine -->
    <script>
        // Parse current portfolio state from PHP
        let portfolioState = {
            slug: {!! json_encode($portfolio->slug) !!},
            title: {!! json_encode($portfolio->title) !!},
            bio: {!! json_encode($portfolio->bio) !!},
            about_text: {!! json_encode($portfolio->about_text) !!},
            skills: {!! json_encode($portfolio->skills) !!},
            projects: {!! json_encode($portfolio->projects ?? []) !!},
            social_links: {!! json_encode($portfolio->social_links ?? []) !!},
            theme_color: {!! json_encode($portfolio->theme_color) !!},
            is_live: {!! json_encode($portfolio->is_live) !!},
            avatar: {!! json_encode($portfolio->avatar) !!},
            banner: {!! json_encode($portfolio->banner) !!}
        };

        // File Uploader handling
        let activeUploaderTarget = null;
        const globalUploader = document.getElementById('global-image-uploader');

        // Setup image edit listeners
        function setupImageEditors() {
            document.querySelectorAll('[data-editable-img]').forEach(el => {
                // Ensure correct layout wrapping
                if (!el.parentElement.classList.contains('img-editable-container')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'img-editable-container';
                    wrapper.style.borderRadius = window.getComputedStyle(el).borderRadius;
                    el.parentNode.insertBefore(wrapper, el);
                    wrapper.appendChild(el);
                    
                    wrapper.addEventListener('click', () => {
                        activeUploaderTarget = el;
                        globalUploader.click();
                    });
                }
            });
        }

        globalUploader.addEventListener('change', function() {
            if (!this.files.length || !activeUploaderTarget) return;
            
            const formData = new FormData();
            formData.append('image', this.files[0]);
            
            const originalText = activeUploaderTarget.parentElement.style.opacity;
            activeUploaderTarget.parentElement.style.opacity = '0.5';

            fetch("{{ route('creator.portfolio.uploadImage') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                activeUploaderTarget.parentElement.style.opacity = '1';
                if (data.url) {
                    activeUploaderTarget.src = data.url;
                    
                    // Save back into local state
                    const field = activeUploaderTarget.getAttribute('data-editable-img');
                    if (field === 'avatar') portfolioState.avatar = data.url;
                    else if (field === 'banner') portfolioState.banner = data.url;
                    else if (field.startsWith('projects.')) {
                        const parts = field.split('.');
                        const index = parseInt(parts[1]);
                        portfolioState.projects[index].image = data.url;
                    }
                } else {
                    alert('Upload failed: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(err => {
                activeUploaderTarget.parentElement.style.opacity = '1';
                console.error(err);
                alert('Upload error.');
            });
        });

        // Setup text edits listeners
        function setupTextEditors() {
            document.querySelectorAll('[data-editable]').forEach(el => {
                el.contentEditable = "true";
                
                el.addEventListener('blur', function() {
                    const field = this.getAttribute('data-editable');
                    const value = this.innerHTML.trim();
                    
                    if (field === 'title') portfolioState.title = this.innerText;
                    else if (field === 'bio') portfolioState.bio = this.innerText;
                    else if (field === 'about_text') portfolioState.innerHTML = value;
                    else if (field.startsWith('projects.')) {
                        const parts = field.split('.');
                        const index = parseInt(parts[1]);
                        const subField = parts[2];
                        if (portfolioState.projects[index]) {
                            portfolioState.projects[index][subField] = this.innerText;
                        }
                    } else if (field.startsWith('social_links.')) {
                        const parts = field.split('.');
                        const platform = parts[1];
                        portfolioState.social_links[platform] = this.innerText;
                    }
                });
            });
        }

        // Color theme selectors
        document.querySelectorAll('.color-circle').forEach(circle => {
            circle.addEventListener('click', function() {
                document.querySelectorAll('.color-circle').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                
                const themeColor = this.getAttribute('data-color');
                portfolioState.theme_color = themeColor;
                
                // Instantly re-apply CSS primary variables based on selected theme color
                const colorConfig = {
                    modern: { default: '#111827', blue: '#2563EB', green: '#059669' },
                    minimal: { default: '#000000', gray: '#4B5563', sand: '#D5BDAF' },
                    developer: { default: '#1E1E1E', dracula: '#282A36', monokai: '#272822' },
                    creative: { default: '#EC4899', orange: '#F97316', purple: '#8B5CF6' },
                    dark: { default: '#121212', 'neon-green': '#39FF14', 'neon-blue': '#00FFFF' }
                };
                
                const template = "{{ $portfolio->template_name }}";
                const hex = colorConfig[template] ? colorConfig[template][themeColor] : '#000000';
                
                document.documentElement.style.setProperty('--primary', hex);
                document.documentElement.style.setProperty('--accent', hex);
            });
        });

        // Add Project dynamically
        document.getElementById('btn-add-project').addEventListener('click', function() {
            // Append dummy project into state
            const newIndex = portfolioState.projects.length;
            const newProject = {
                title: 'New Custom Work',
                description: 'Describe your newly completed creative concept here. Click here to change this.',
                link: 'https://example.com',
                image: 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80'
            };
            portfolioState.projects.push(newProject);
            
            // Re-render templates wrapper with new state
            alert('New project added! Scroll down to find the newly inserted block and edit it.');
            
            // For simple instant dynamic rendering, we can trigger save first or inject a dummy card
            saveChanges(false, () => {
                window.location.reload(); // Reload to cleanly render the newly added record in Blade template
            });
        });

        // Save Portfolio changes via AJAX
        function saveChanges(redirect = true, callback = null) {
            const saveBtn = document.getElementById('btn-save');
            const originalText = saveBtn.innerText;
            saveBtn.innerText = 'Saving...';
            saveBtn.disabled = true;
            
            portfolioState.is_live = document.getElementById('chk-live').checked ? 1 : 0;
            portfolioState.slug = document.getElementById('txt-slug').value.trim();

            fetch("{{ route('creator.portfolio.saveAjax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(portfolioState)
            })
            .then(res => res.json())
            .then(data => {
                saveBtn.innerText = originalText;
                saveBtn.disabled = false;
                if (data.success) {
                    if (callback) callback();
                    else if (redirect) {
                        alert('Your portfolio changes have been saved successfully!');
                        window.location.href = "{{ route('creator.portfolio.index') }}";
                    }
                } else {
                    alert('Save failed: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(err => {
                saveBtn.innerText = originalText;
                saveBtn.disabled = false;
                console.error(err);
                alert('Save error.');
            });
        }

        document.getElementById('btn-save').addEventListener('click', () => saveChanges(true));

        document.getElementById('btn-back').addEventListener('click', function() {
            if (confirm('Any unsaved changes will be lost. Exit anyway?')) {
                window.location.href = "{{ route('creator.portfolio.index') }}";
            }
        });

        // Initialize editor features
        window.addEventListener('DOMContentLoaded', () => {
            setupTextEditors();
            setupImageEditors();
        });
    </script>
</body>
</html>
