 <footer class="bg-gray-100 dark:bg-gray-900 py-8 bg-[var(--secondary)]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--primary)]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-lg">SiteMonitor</span>
                </div>
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[var(--primary)] transition-colors">About Us</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[var(--primary)] transition-colors">Features</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[var(--primary)] transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[var(--primary)] transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[var(--primary)] transition-colors">Contact</a>
                </div>
            </div>
            <div class="mt-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                © 2023 SiteMonitor. All rights reserved.
            </div>
            
            <!-- Keyword Stuffing Section -->
            <div class="mt-8 text-xs text-gray-400 dark:text-gray-600 leading-relaxed text-center max-w-4xl mx-auto">
                <p>
                    Website sitemap generator, sitemap XML creator, website URL extractor, website structure analyzer, 
                    404 error finder, broken link checker, website crawler, SEO sitemap tool, website URL list generator, 
                    website structure visualization, website mapping tool, site structure analysis, website URL export, 
                    website navigation map, website architecture analyzer, XML sitemap generator, website URL crawler, 
                    website link extractor, website structure scanner, website URL mapper, website page indexer, 
                    website link analyzer, website structure explorer, website URL inventory, website page catalog, 
                    website link directory, website structure audit, website URL database, website page registry
                </p>
            </div>
        </div>
    </footer>

    <div id="progress-bar-container">
        <div id="progress-bar"></div>
    </div>
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
        const body = document.body;
        
        // Check for saved theme preference or use preferred color scheme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.classList.remove('light', 'dark');
            body.classList.add(savedTheme);
            themeToggle.checked = savedTheme === 'dark';
            mobileThemeToggle.checked = savedTheme === 'dark';
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDark) {
                body.classList.remove('light');
                body.classList.add('dark');
                themeToggle.checked = true;
                mobileThemeToggle.checked = true;
            }
        }
        
        function toggleTheme(isDark) {
            if (isDark) {
                body.classList.remove('light');
                body.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                themeToggle.checked = true;
                mobileThemeToggle.checked = true;
            } else {
                body.classList.remove('dark');
                body.classList.add('light');
                localStorage.setItem('theme', 'light');
                themeToggle.checked = false;
                mobileThemeToggle.checked = false;
            }
        }
        
        themeToggle.addEventListener('change', function() {
            toggleTheme(this.checked);
        });
        
        mobileThemeToggle.addEventListener('change', function() {
            toggleTheme(this.checked);
        });
                // Mobile Menu Functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMenuButton = document.getElementById('close-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
        
        closeMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('open');
            document.body.style.overflow = '';
        });
        
        // Tab Switching Functionality
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.getAttribute('data-tab');
                
                // Remove active class from all buttons and add to clicked button
                tabBtns.forEach(b => b.classList.remove('tab-active'));
                btn.classList.add('tab-active');
                
                // Hide all tab contents and show the selected one
                tabContents.forEach(content => content.classList.add('hidden'));
                document.getElementById(`${tabId}-tab`).classList.remove('hidden');
            });
        });
    </script>

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93c98a3f55c346ae',t:'MTc0NjcxMzQyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><iframe height="1" width="1" style="position: absolute; top: 0px; left: 0px; border: none; visibility: hidden;"></iframe>
</body></html>