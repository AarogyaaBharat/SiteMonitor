<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteMonitor - Website Analysis Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-light: #6366f1;
            --secondary-light: #8b5cf6;
            --accent-light: #ec4899;
            --bg-light: #f8fafc;
            --text-light: #1e293b;
            
            --primary-dark: #818cf8;
            --secondary-dark: #a78bfa;
            --accent-dark: #f472b6;
            --bg-dark: #0f172a;
            --text-dark: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        

.light {
    --primary: var(--primary-light);
    --secondary: var(--secondary-light);
    --accent: var(--accent-light);
    --bg: #ebebeb;
    --text: #111827;
}

.light body {
    background-color: var(--bg);
    color: var(--text);
}

.light .card {
    background-color: #ffffff;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

.light .btn {
    background-color: var(--primary-light);
    color: #ffffff;
}

.light .btn:hover {
    background-color: var(--secondary-light);
}

.light input,
.light textarea {
    background-color: #f1f5f9;
    color: #111827;
    border-color: #cbd5e1;
}

.light input::placeholder {
    color: #94a3b8;
}

.light .bg-[var(--bg)] {
    background-color: #ffffff !important;
}

.light .text-[var(--text)] {
    color: var(--text-light);
}

.light .shadow-lg,
.light .shadow-md,
.light .shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.light .dark\:bg-gray-800 {
    background-color: #f8fafc !important;
}

.light .dark\:text-gray-400 {
    color: #6b7280 !important;
}

.light .dark\:border-gray-700 {
    border-color: #e2e8f0 !important;
}


.light .card {
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.light .btn {
    background-color: var(--primary-light);
    color: #fff;
}

.light .btn:hover {
    background-color: var(--secondary-light);
}

.light .text-[var(--text)] {
    color: var(--text-light);
}

.light .bg-[var(--bg)] {
    background-color: var(--bg-light);
}

        
        .dark {
            --primary: var(--primary-dark);
            --secondary: var(--secondary-dark);
            --accent: var(--accent-dark);
            --bg: var(--bg-dark);
            --text: var(--text-dark);
        }
        
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }
        
        .btn:hover:after {
            width: 300px;
            height: 300px;
        }
        
        .tab-active {
            position: relative;
        }
        
        .tab-active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--accent);
        }
        
        .toggle-checkbox:checked {
            right: 0;
            border-color: var(--secondary);
        }
        
        .toggle-checkbox:checked + .toggle-label {
            background-color: var(--secondary);
        }
        
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .result-item {
            transition: all 0.2s ease;
        }
        
        .result-item:hover {
            transform: scale(1.01);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive table styles */
        .responsive-table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Mobile menu styles */
        .mobile-menu {
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        /* Responsive tab styles */
        @media (max-width: 640px) {
            .tab-container {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 5px;
            }
            
            .tab-btn {
                display: inline-block;
            }
        }
    </style>
<style>*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }/* ! tailwindcss v3.4.16 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}.container{width:100%}@media (min-width: 640px){.container{max-width:640px}}@media (min-width: 768px){.container{max-width:768px}}@media (min-width: 1024px){.container{max-width:1024px}}@media (min-width: 1280px){.container{max-width:1280px}}@media (min-width: 1536px){.container{max-width:1536px}}.fixed{position:fixed}.absolute{position:absolute}.relative{position:relative}.sticky{position:sticky}.inset-0{inset:0px}.top-0{top:0px}.z-50{z-index:50}.mx-auto{margin-left:auto;margin-right:auto}.mb-16{margin-bottom:4rem}.mb-2{margin-bottom:0.5rem}.mb-4{margin-bottom:1rem}.mb-6{margin-bottom:1.5rem}.mb-8{margin-bottom:2rem}.ml-2{margin-left:0.5rem}.ml-4{margin-left:1rem}.ml-8{margin-left:2rem}.mr-2{margin-right:0.5rem}.mt-1{margin-top:0.25rem}.mt-10{margin-top:2.5rem}.mt-2{margin-top:0.5rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.mt-8{margin-top:2rem}.block{display:block}.inline-block{display:inline-block}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.hidden{display:none}.h-12{height:3rem}.h-2{height:0.5rem}.h-3{height:0.75rem}.h-4{height:1rem}.h-6{height:1.5rem}.h-8{height:2rem}.h-96{height:24rem}.h-auto{height:auto}.w-10{width:2.5rem}.w-12{width:3rem}.w-2{width:0.5rem}.w-3{width:0.75rem}.w-4{width:1rem}.w-6{width:1.5rem}.w-8{width:2rem}.w-full{width:100%}.min-w-full{min-width:100%}.max-w-4xl{max-width:56rem}.max-w-md{max-width:28rem}.flex-1{flex:1 1 0%}.translate-x-full{--tw-translate-x:100%;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.transform{transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.cursor-pointer{cursor:pointer}.select-none{-webkit-user-select:none;user-select:none}.appearance-none{-webkit-appearance:none;appearance:none}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.flex-col{flex-direction:column}.flex-wrap{flex-wrap:wrap}.items-start{align-items:flex-start}.items-center{align-items:center}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.space-x-2 > :not([hidden]) ~ :not([hidden]){--tw-space-x-reverse:0;margin-right:calc(0.5rem * var(--tw-space-x-reverse));margin-left:calc(0.5rem * calc(1 - var(--tw-space-x-reverse)))}.space-x-6 > :not([hidden]) ~ :not([hidden]){--tw-space-x-reverse:0;margin-right:calc(1.5rem * var(--tw-space-x-reverse));margin-left:calc(1.5rem * calc(1 - var(--tw-space-x-reverse)))}.space-y-2 > :not([hidden]) ~ :not([hidden]){--tw-space-y-reverse:0;margin-top:calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(0.5rem * var(--tw-space-y-reverse))}.space-y-4 > :not([hidden]) ~ :not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1rem * var(--tw-space-y-reverse))}.space-y-6 > :not([hidden]) ~ :not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1.5rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1.5rem * var(--tw-space-y-reverse))}.divide-y > :not([hidden]) ~ :not([hidden]){--tw-divide-y-reverse:0;border-top-width:calc(1px * calc(1 - var(--tw-divide-y-reverse)));border-bottom-width:calc(1px * var(--tw-divide-y-reverse))}.divide-gray-200 > :not([hidden]) ~ :not([hidden]){--tw-divide-opacity:1;border-color:rgb(229 231 235 / var(--tw-divide-opacity, 1))}.overflow-auto{overflow:auto}.overflow-hidden{overflow:hidden}.overflow-x-auto{overflow-x:auto}.whitespace-nowrap{white-space:nowrap}.break-all{word-break:break-all}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-xl{border-radius:0.75rem}.rounded-l-lg{border-top-left-radius:0.5rem;border-bottom-left-radius:0.5rem}.rounded-r-lg{border-top-right-radius:0.5rem;border-bottom-right-radius:0.5rem}.border{border-width:1px}.border-4{border-width:4px}.border-b{border-bottom-width:1px}.border-l-2{border-left-width:2px}.border-\[var\(--primary\)\]{border-color:var(--primary)}.border-gray-200{--tw-border-opacity:1;border-color:rgb(229 231 235 / var(--tw-border-opacity, 1))}.border-gray-300{--tw-border-opacity:1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.border-red-200{--tw-border-opacity:1;border-color:rgb(254 202 202 / var(--tw-border-opacity, 1))}.bg-\[var\(--bg\)\]{background-color:var(--bg)}.bg-\[var\(--accent\)\]{background-color:var(--accent)}.bg-\[var\(--primary\)\]{background-color:var(--primary)}.bg-\[var\(--secondary\)\]{background-color:var(--secondary)}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.bg-gray-300{--tw-bg-opacity:1;background-color:rgb(209 213 219 / var(--tw-bg-opacity, 1))}.bg-green-100{--tw-bg-opacity:1;background-color:rgb(220 252 231 / var(--tw-bg-opacity, 1))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity, 1))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity, 1))}.bg-opacity-20{--tw-bg-opacity:0.2}.bg-gradient-to-r{background-image:linear-gradient(to right, var(--tw-gradient-stops))}.from-\[var\(--primary\)\]{--tw-gradient-from:var(--primary) var(--tw-gradient-from-position);--tw-gradient-to:rgb(255 255 255 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.to-\[var\(--accent\)\]{--tw-gradient-to:var(--accent) var(--tw-gradient-to-position)}.to-\[var\(--secondary\)\]{--tw-gradient-to:var(--secondary) var(--tw-gradient-to-position)}.bg-clip-text{-webkit-background-clip:text;background-clip:text}.p-4{padding:1rem}.p-6{padding:1.5rem}.px-2{padding-left:0.5rem;padding-right:0.5rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-1{padding-top:0.25rem;padding-bottom:0.25rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.py-3{padding-top:0.75rem;padding-bottom:0.75rem}.py-4{padding-top:1rem;padding-bottom:1rem}.py-8{padding-top:2rem;padding-bottom:2rem}.pl-6{padding-left:1.5rem}.text-left{text-align:left}.text-center{text-align:center}.align-middle{vertical-align:middle}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-base{font-size:1rem;line-height:1.5rem}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-xs{font-size:0.75rem;line-height:1rem}.font-bold{font-weight:700}.font-medium{font-weight:500}.font-semibold{font-weight:600}.uppercase{text-transform:uppercase}.leading-relaxed{line-height:1.625}.leading-tight{line-height:1.25}.tracking-wider{letter-spacing:0.05em}.text-\[var\(--text\)\]{color:var(--text)}.text-\[var\(--accent\)\]{color:var(--accent)}.text-\[var\(--primary\)\]{color:var(--primary)}.text-\[var\(--secondary\)\]{color:var(--secondary)}.text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.text-gray-800{--tw-text-opacity:1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.text-green-800{--tw-text-opacity:1;color:rgb(22 101 52 / var(--tw-text-opacity, 1))}.text-red-600{--tw-text-opacity:1;color:rgb(220 38 38 / var(--tw-text-opacity, 1))}.text-red-700{--tw-text-opacity:1;color:rgb(185 28 28 / var(--tw-text-opacity, 1))}.text-transparent{color:transparent}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.opacity-80{opacity:0.8}.shadow-lg{--tw-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-md{--tw-shadow:0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-sm{--tw-shadow:0 1px 2px 0 rgb(0 0 0 / 0.05);--tw-shadow-colored:0 1px 2px 0 var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.transition-colors{transition-property:color, background-color, border-color, fill, stroke, -webkit-text-decoration-color;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, -webkit-text-decoration-color;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.hover\:bg-\[var\(--primary\)\]:hover{background-color:var(--primary)}.hover\:bg-opacity-10:hover{--tw-bg-opacity:0.1}.hover\:text-\[var\(--primary\)\]:hover{color:var(--primary)}.hover\:shadow-lg:hover{--tw-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.hover\:shadow-xl:hover{--tw-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus\:ring-2:focus{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus\:ring-\[var\(--primary\)\]:focus{--tw-ring-color:var(--primary)}@media (min-width: 640px){.sm\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.sm\:flex-row{flex-direction:row}.sm\:items-center{align-items:center}.sm\:justify-between{justify-content:space-between}.sm\:gap-6{gap:1.5rem}.sm\:gap-8{gap:2rem}.sm\:space-x-4 > :not([hidden]) ~ :not([hidden]){--tw-space-x-reverse:0;margin-right:calc(1rem * var(--tw-space-x-reverse));margin-left:calc(1rem * calc(1 - var(--tw-space-x-reverse)))}.sm\:space-y-0 > :not([hidden]) ~ :not([hidden]){--tw-space-y-reverse:0;margin-top:calc(0px * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(0px * var(--tw-space-y-reverse))}.sm\:p-6{padding:1.5rem}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:text-2xl{font-size:1.5rem;line-height:2rem}.sm\:text-4xl{font-size:2.25rem;line-height:2.5rem}.sm\:text-lg{font-size:1.125rem;line-height:1.75rem}}@media (min-width: 768px){.md\:mb-0{margin-bottom:0px}.md\:flex{display:flex}.md\:hidden{display:none}.md\:w-1\/2{width:50%}.md\:flex-row{flex-direction:row}.md\:text-5xl{font-size:3rem;line-height:1}}@media (min-width: 1024px){.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}}@media (prefers-color-scheme: dark){.dark\:divide-gray-700 > :not([hidden]) ~ :not([hidden]){--tw-divide-opacity:1;border-color:rgb(55 65 81 / var(--tw-divide-opacity, 1))}.dark\:border-gray-600{--tw-border-opacity:1;border-color:rgb(75 85 99 / var(--tw-border-opacity, 1))}.dark\:border-gray-700{--tw-border-opacity:1;border-color:rgb(55 65 81 / var(--tw-border-opacity, 1))}.dark\:border-red-800\/30{border-color:rgb(153 27 27 / 0.3)}.dark\:bg-gray-700{--tw-bg-opacity:1;background-color:rgb(55 65 81 / var(--tw-bg-opacity, 1))}.dark\:bg-gray-800{--tw-bg-opacity:1;background-color:rgb(31 41 55 / var(--tw-bg-opacity, 1))}.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity, 1))}.dark\:bg-green-900{--tw-bg-opacity:1;background-color:rgb(20 83 45 / var(--tw-bg-opacity, 1))}.dark\:bg-red-900\/20{background-color:rgb(127 29 29 / 0.2)}.dark\:text-gray-200{--tw-text-opacity:1;color:rgb(229 231 235 / var(--tw-text-opacity, 1))}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.dark\:text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.dark\:text-green-200{--tw-text-opacity:1;color:rgb(187 247 208 / var(--tw-text-opacity, 1))}.dark\:text-red-300{--tw-text-opacity:1;color:rgb(252 165 165 / var(--tw-text-opacity, 1))}.dark\:text-red-400{--tw-text-opacity:1;color:rgb(248 113 113 / var(--tw-text-opacity, 1))}}</style></head>
<style>
    /* Custom styles for the upload section */
    #upload-excel-form {
        margin-top: 20px;
    }

    #upload-excel-form input[type="file"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
    }

    #upload-excel-form button {
        margin-top: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    #upload-excel-form button:hover {
        background-color: #45a049;
    }

    #upload-result {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    #upload-result h3 {
        margin-bottom: 10px;
    }

    #upload-result ul {
        list-style-type: disc;
        margin-left: 20px;
    }
</style>
<style>
    /* Progress bar styles */
    #progress-bar-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background-color: rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    #progress-bar {
        width: 0;
        height: 100%;
        background-color: #4caf50;
        transition: width 0.4s ease;
    }
    .loader-container {
            background-color: rgba(30, 30, 60, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
          
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .circle-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }
        
        .outer-ring {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-top: 3px solid transparent;
            animation: spin 2s linear infinite;
        }
        
        .middle-ring {
            position: absolute;
            width: 120px;
            height: 120px;
            top: 15px;
            left: 15px;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-right: 5px solid #4f46e5;
            animation: spin 1.5s linear infinite reverse;
        }
        
        .inner-circle {
            position: absolute;
            width: 90px;
            height: 90px;
            top: 30px;
            left: 30px;
            border-radius: 50%;
            background: linear-gradient(145deg, #4f46e5, #9333ea);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.5rem;
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.6);
        }
        
        .dots {
            position: absolute;
            width: 100%;
            height: 100%;
            animation: spin 8s linear infinite;
        }
        
        .dot {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #4f46e5;
        }
        
        .dot:nth-child(1) { top: 10px; left: 50%; transform: translateX(-50%); }
        .dot:nth-child(2) { top: 50%; right: 10px; transform: translateY(-50%); }
        .dot:nth-child(3) { bottom: 10px; left: 50%; transform: translateX(-50%); }
        .dot:nth-child(4) { top: 50%; left: 10px; transform: translateY(-50%); }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .progress-bar {
            height: 6px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            margin: 1.5rem 0;
            overflow: hidden;
            position: relative;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4f46e5, #9333ea);
            border-radius: 3px;
            transition: width 0.5s ease;
            position: relative;
        }
        
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.3) 50%, 
                rgba(255,255,255,0) 100%);
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .status-text {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
            background: linear-gradient(90deg, #4f46e5, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .detail-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .stat-item {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4f46e5;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.25rem;
        }
</style>
</head>
<body class="light bg-[var(--bg)] text-[var(--text)]">
    <!-- Upload Modal -->
<div id="uploadPopup" class="fixed inset-0 bg-[rgba(0,0,0,0.6)] flex items-center justify-center z-50 fade-in" style="display: none;">
    <div class="bg-[var(--bg)] text-[var(--text)] p-6 rounded-2xl w-full max-w-md shadow-xl relative">
        <!-- Close button -->
        <button onclick="closePopup()" class="absolute top-3 right-3 text-xl font-bold text-[var(--text)] hover:text-[var(--accent)] transition">&times;</button>

        <!-- Heading -->
        <h2 class="text-lg font-semibold mb-4 text-center">Upload CSV or Excel File</h2>

        <!-- Drop Zone -->
        <div id="dropArea"
             class="border-2 border-dashed border-[var(--primary)] rounded-xl p-6 text-center cursor-pointer transition"
             ondragover="event.preventDefault()"
             ondrop="handleDrop(event)">
            <p class="mb-2">Drag and drop your file here</p>
            <p class="text-sm text-[var(--text)] opacity-70">(.csv, .xls, .xlsx only)</p>
            <p id="fileName" class="mt-2 text-sm font-medium text-[var(--accent)]"></p>
        </div>

        <!-- Browse Button -->
        <div class="text-center mt-5">
         <form id="upload-excel-form" action="{{url('/')}}/check-urls-from-excel" method="POST" enctype="multipart/form-data" class="flex flex-col items-center space-y-4">
            @csrf
            <input id="fileInput" name="excel_file" type="file" accept=".csv,.xls,.xlsx" onchange="handleFile(this.files[0])" class="hidden" />
            <button id="fileBtn" type="button" class="btn px-4 py-2 rounded-xl bg-[var(--secondary)] text-white" onclick="triggerFile()">Browse File</button>
         </form>
        </div>
    </div>
</div>
    <nav class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 sticky top-0 z-50 bg-[var(--bg)]">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--primary)]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-bold text-xl bg-gradient-to-r from-[var(--primary)] to-[var(--accent)] inline-block text-transparent bg-clip-text">SiteMonitor</span>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors">Home</a>
                <div class="relative group">
                    <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors flex items-center">
                        Features
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute left-0 mt-2 w-48 bg-[var(--bg)] border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity z-50">
                        <a href="{{ route('check-urls-regx') }}" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white rounded-t-lg transition-colors">Regex Check</a>
                        <a href="{{ route('check-page-speed') }}" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white transition-colors">Performance Reports</a>
                        <script>
                            // Show dropdown for 1 second on hover
                            document.addEventListener('DOMContentLoaded', function() {
                                const group = document.querySelector('.group');
                                const dropdown = group?.querySelector('.absolute');
                                let timeout;
                                if (group && dropdown) {
                                    group.addEventListener('mouseenter', () => {
                                        dropdown.classList.add('opacity-100', 'pointer-events-auto');
                                        dropdown.classList.remove('opacity-0', 'pointer-events-none');
                                        clearTimeout(timeout);
                                        timeout = setTimeout(() => {
                                            dropdown.classList.remove('opacity-100', 'pointer-events-auto');
                                            dropdown.classList.add('opacity-0', 'pointer-events-none');
                                        }, 1000);
                                    });
                                    group.addEventListener('mouseleave', () => {
                                        clearTimeout(timeout);
                                        dropdown.classList.remove('opacity-100', 'pointer-events-auto');
                                        dropdown.classList.add('opacity-0', 'pointer-events-none');
                                    });
                                }
                            });
                        </script>
                        <a href="#" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white rounded-b-lg transition-colors">BackLink Finder</a>
                    </div>
                </div>
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors">About</a>
                <div class="flex items-center ml-4">
                    <span class="mr-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                        </svg>
                    </span>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none">
                        <input type="checkbox" id="theme-toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
                        <label for="theme-toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </span>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-[var(--text)] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed inset-0 bg-[var(--bg)] z-50 transform translate-x-full md:hidden">
            <div class="flex justify-end p-4">
                <button id="close-menu-button" class="text-[var(--text)] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col items-center space-y-6 mt-10">
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors text-lg">Home</a>
                <div class="relative group w-full flex flex-col items-center">
                    <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors text-lg flex items-center justify-center">
                        Features
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-[var(--bg)] border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity z-50">
                        <a href="{{ route('check-urls-regx') }}" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white rounded-t-lg transition-colors">Regex Check</a>
                        <a href="{{ route('check-page-speed') }}" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white transition-colors">Performance Reports</a>
                        <a href="#" class="block px-4 py-2 text-[var(--text)] hover:bg-[var(--primary)] hover:text-white rounded-b-lg transition-colors">BackLink Finder</a>
                    </div>
                </div>
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors text-lg">About</a>
                <div class="flex items-center mt-4">
                    <span class="mr-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                        </svg>
                    </span>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none">
                        <input type="checkbox" id="mobile-theme-toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
                        <label for="mobile-theme-toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </nav>