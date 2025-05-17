<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteMonitor - Website Analysis Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors">Features</a>
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
                <a href="#" class="text-[var(--text)] hover:text-[var(--primary)] transition-colors text-lg">Features</a>
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

    <main class="container mx-auto px-4 py-8">
        <section class="mb-16">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight">Analyze Your Website Structure <span class="bg-gradient-to-r from-[var(--primary)] to-[var(--accent)] inline-block text-transparent bg-clip-text">Effortlessly</span></h1>
                    <p class="text-base sm:text-lg mb-6 opacity-80">Generate site maps, download URLs, and identify 404 errors with our powerful website analysis tool.</p>
                    <div class="flex flex-wrap gap-4">
                    <a href="{{url('/')}}/#input"><button class="btn bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl">Get Started</button></a>
                        <button class="btn border border-[var(--primary)] text-[var(--primary)] px-6 py-3 rounded-lg font-medium hover:bg-[var(--primary)] hover:bg-opacity-10">Learn More</button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <svg class="animate-float w-full h-auto" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path fill="var(--primary)" d="M47.7,-57.2C59.9,-45.7,67.2,-29.7,69.2,-13.5C71.2,2.8,68,19.3,59.5,32.5C51.1,45.7,37.3,55.6,22.1,61.7C6.9,67.8,-9.7,70.2,-25.4,66.2C-41.1,62.3,-55.9,52,-65.3,37.7C-74.7,23.4,-78.7,5.2,-74.4,-10.9C-70.2,-27,-57.6,-41,-43.4,-52.2C-29.2,-63.4,-13.4,-71.8,1.9,-74C17.2,-76.2,35.5,-68.7,47.7,-57.2Z" transform="translate(100 100)"></path>
                            <g transform="translate(40, 40)">
                                <rect x="10" y="10" width="100" height="100" rx="8" fill="white" opacity="0.9"></rect>
                                <line x1="30" y1="40" x2="90" y2="40" stroke="var(--primary)" stroke-width="4"></line>
                                <line x1="30" y1="60" x2="90" y2="60" stroke="var(--secondary)" stroke-width="4"></line>
                                <line x1="30" y1="80" x2="70" y2="80" stroke="var(--accent)" stroke-width="4"></line>
                                <circle cx="20" cy="40" r="4" fill="var(--primary)"></circle>
                                <circle cx="20" cy="60" r="4" fill="var(--secondary)"></circle>
                                <circle cx="20" cy="80" r="4" fill="var(--accent)"></circle>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        

        <section id="input" class="mb-16 scroll-mt-24">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 transition-all">
                <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center">Enter Your Website URL</h2>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <input type="text" id="website-url" placeholder="https://example.com" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                    <button id="analyze-btn" class="btn bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white px-6 py-3 rounded-lg font-medium shadow-md hover:shadow-lg">
                        Analyze Website
                    </button>
                    <button onclick="openPopup()" class="btn px-4 py-2 rounded-xl bg-[var(--accent)] text-white">Upload File</button>
                </div>
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                    We'll scan your website and generate a complete analysis
                </div>
                
            </div>
        </section>
          
        <section id="analysis-results" class="mb-16 hidden">
            <div class="flex justify-center mb-8">
                <div class="tab-container inline-flex rounded-md shadow-sm overflow-x-auto w-full justify-center" role="group">
                    <button type="button" class="tab-btn tab-active px-4 sm:px-6 py-2 text-sm font-medium rounded-l-lg" data-tab="sitemap" id="sitemap-tab-btn">
                        Site Map
                    </button>
                    <button type="button" class="tab-btn px-4 sm:px-6 py-2 text-sm font-medium" data-tab="urls">
                        All URLs
                    </button>
                    <button type="button" class="tab-btn px-4 sm:px-6 py-2 text-sm font-medium rounded-r-lg" data-tab="errors">
                        404 Errors
                    </button>
                </div>
            </div>

            <div id="results-container">
                <!-- Sitemap Tab Content -->
                <div id="sitemap-tab" class="tab-content">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <h3 class="text-xl font-bold">Site Map Visualization</h3>
                            <button id="download-sitemap" class="btn flex items-center space-x-2 bg-[var(--primary)] text-white px-4 py-2 rounded-lg text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>Download XML</span>
                            </button>
                        </div>
                        <div class="sitemap-visualization border border-gray-200 dark:border-gray-700 rounded-lg p-4 h-96 overflow-auto">
                          
                            <div class="ml-8 border-l-2 border-gray-300 dark:border-gray-600 pl-6 space-y-4">
                               
                            </div>
                        </div>
                    </div>
                </div>

                <!-- URLs Tab Content -->
                <div id="urls-tab" class="tab-content hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <h3 class="text-xl font-bold">All URLs (12 found)</h3>
                            <button id="download-urls" class="btn flex items-center space-x-2 bg-[var(--primary)] text-white px-4 py-2 rounded-lg text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>Download CSV</span>
                            </button>
                        </div>
                        <div class="responsive-table">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">URL</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Modified</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 404 Errors Tab Content -->
                <div id="errors-tab" class="tab-content hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <h3 class="text-xl font-bold">404 Errors (3 found)</h3>
                            <button id="download-errors" class="btn flex items-center space-x-2 bg-[var(--primary)] text-white px-4 py-2 rounded-lg text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>Download CSV</span>
                            </button>
                        </div>
                        <div class="space-y-4">
                          
                    </div>
                </div>
            </div>
        </section>
         <section id="pre-analysis-info" class="mb-16">
            <h2 class="text-xl sm:text-2xl font-bold mb-8 text-center">How It Works</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
              
              <!-- Step 1 -->
              <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="w-12 h-12 bg-[var(--primary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                    <svg viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <title>url [#1424]</title>
                          <desc>Created with Sketch.</desc>
                          <defs></defs>
                          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Dribbble-Light-Preview" transform="translate(-299.000000, -600.000000)" fill="#ffffff">
                              <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M246.400111,448.948654 C244.519883,447.158547 244.754644,444.106996 247.102248,442.631229 C248.809889,441.557573 251.103895,441.880078 252.551048,443.257869 L253.222099,443.896756 C253.641237,444.295804 254.319791,444.295804 254.737858,443.896756 C255.156996,443.498727 255.156996,442.852696 254.737858,442.453648 L254.170788,441.913758 C251.680612,439.542937 247.589992,439.302079 245.025851,441.600438 C242.372737,443.979423 242.32557,447.956645 244.884352,450.391762 L245.642231,451.113316 C246.060298,451.512365 246.739924,451.512365 247.15799,451.113316 C247.577129,450.715288 247.577129,450.069257 247.15799,449.670208 L246.400111,448.948654 Z M261.976841,449.345662 L261.430138,448.825163 C261.011,448.426114 260.332446,448.426114 259.914379,448.825163 C259.495241,449.223192 259.495241,449.869222 259.914379,450.268271 L260.585429,450.907158 C262.032583,452.284948 262.370252,454.469002 261.243616,456.094794 C259.693554,458.329877 256.487306,458.552364 254.60815,456.763278 L253.850271,456.041724 C253.431132,455.642675 252.752578,455.642675 252.334511,456.041724 C251.915373,456.439752 251.915373,457.085783 252.334511,457.484832 L253.092391,458.206386 C255.643669,460.63538 259.806111,460.597618 262.305934,458.09106 C264.742511,455.648799 264.478808,451.727709 261.976841,449.345662 L261.976841,449.345662 Z M257.639668,455.32017 L247.91587,446.062438 C247.497803,445.663389 247.497803,445.017358 247.91587,444.61831 C248.335008,444.220281 249.013562,444.220281 249.431629,444.61831 L259.156499,453.876041 C259.574566,454.27509 259.574566,454.921121 259.156499,455.32017 C258.737361,455.718198 258.058807,455.718198 257.639668,455.32017 L257.639668,455.32017 Z" id="url-[#1424]"> </path>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                                      </div>
                <h3 class="text-xl font-semibold mb-2">Step 1: Enter URL</h3>
                <p class="text-gray-600 dark:text-gray-400">Enter your website URL in the input field above and click "Analyze Website" to begin the scanning process.</p>
              </div>
          
              <!-- Step 2 -->
              <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="w-12 h-12 bg-[var(--secondary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                    <svg fill="#ffffff" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path d="M 13.5039 50.9570 L 26.3476 50.9570 C 25.1055 49.9023 24.0508 48.6367 23.2773 47.1836 L 13.7148 47.1836 C 11.3008 47.1836 10.0117 45.9414 10.0117 43.5976 L 10.0117 8.1367 C 10.0117 5.8164 11.2773 4.4805 13.7148 4.4805 L 38.2070 4.4805 C 40.5508 4.4805 41.8867 5.7930 41.8867 8.1367 L 41.8867 28.5742 C 43.3398 29.3476 44.6055 30.3789 45.6602 31.6211 L 45.6602 8.0664 C 45.6602 3.1679 43.2461 .7070 38.3945 .7070 L 13.5039 .7070 C 8.6758 .7070 6.2383 3.1914 6.2383 8.0664 L 6.2383 43.6211 C 6.2383 48.5195 8.6758 50.9570 13.5039 50.9570 Z M 17.0898 14.0430 L 34.8555 14.0430 C 35.6758 14.0430 36.3086 13.3867 36.3086 12.5664 C 36.3086 11.7695 35.6758 11.1601 34.8555 11.1601 L 17.0898 11.1601 C 16.2227 11.1601 15.6133 11.7695 15.6133 12.5664 C 15.6133 13.3867 16.2227 14.0430 17.0898 14.0430 Z M 17.0898 22.2226 L 34.8555 22.2226 C 35.6758 22.2226 36.3086 21.5664 36.3086 20.7461 C 36.3086 19.9492 35.6758 19.3398 34.8555 19.3398 L 17.0898 19.3398 C 16.2227 19.3398 15.6133 19.9492 15.6133 20.7461 C 15.6133 21.5664 16.2227 22.2226 17.0898 22.2226 Z M 35.1367 50.9570 C 37.2461 50.9570 39.2383 50.3476 40.8789 49.2461 L 46.1524 54.5430 C 46.7148 55.0820 47.2305 55.2930 47.8633 55.2930 C 48.9414 55.2930 49.7617 54.4492 49.7617 53.2539 C 49.7617 52.7383 49.5040 52.2226 49.1056 51.8242 L 43.7617 46.4805 C 44.9570 44.7695 45.6602 42.6836 45.6602 40.4336 C 45.6602 34.5976 40.9492 29.8867 35.1367 29.8867 C 29.3242 29.8867 24.5664 34.6445 24.5664 40.4336 C 24.5664 46.2461 29.3242 50.9570 35.1367 50.9570 Z M 35.1367 47.6054 C 31.1524 47.6054 27.9180 44.3945 27.9180 40.4336 C 27.9180 36.5195 31.1524 33.2617 35.1367 33.2617 C 39.0508 33.2617 42.2851 36.5195 42.2851 40.4336 C 42.2851 44.3945 39.0742 47.6054 35.1367 47.6054 Z"/>
                        </g>
                      </svg>
                      
                </div>
                <h3 class="text-xl font-semibold mb-2">Step 2: Analyze Results</h3>
                <p class="text-gray-600 dark:text-gray-400">Our system will crawl your website and generate a comprehensive analysis including site map, URLs, and 404 errors.</p>
              </div>
          
              <!-- Step 3 -->
              <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="w-12 h-12 bg-[var(--accent)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" 
                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M15 21H9C6.17157 21 4.75736 21 3.87868 20.1213C3 19.2426 3 17.8284 3 15M21 15C21 17.8284 21 19.2426 20.1213 20.1213C19.8215 20.4211 19.4594 20.6186 19 20.7487" 
                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                      </svg>
                      
                </div>
                <h3 class="text-xl font-semibold mb-2">Step 3: Download Data</h3>
                <p class="text-gray-600 dark:text-gray-400">Download your site map as XML, URL list as CSV, and 404 errors report to improve your website's structure.</p>
              </div>
          
              <!-- Step 4 -->
              <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="w-12 h-12 bg-[var(--accent)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path d="M22 2L13.8 10.2" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M13 6.17004V11H17.83" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </svg>
                      
                </div>
                <h3 class="text-xl font-semibold mb-2">Step 4: Import URLs</h3>
                <p class="text-gray-600 dark:text-gray-400">Import an existing list of URLs to analyze and cross-check them with your live website structure.</p>
              </div>
          
            </div>
          </section>

        <section class="mb-16">
          <section class="mb-16">
            <h2 class="text-xl sm:text-2xl font-bold mb-8 text-center">Key Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- Feature 1 -->
                <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-[var(--secondary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                        <svg height="200px" width="200px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <style type="text/css"> .st0{fill:#ffffff;} </style>
                              <g>
                                <path class="st0" d="M378.406,0H208.29h-13.176l-9.314,9.314L57.013,138.102l-9.314,9.314v13.176v265.514 
                                  c0,47.36,38.528,85.895,85.895,85.895h244.812c47.368,0,85.895-38.535,85.895-85.895V85.896C464.301,38.528,425.773,0,378.406,0z 
                                  M432.49,426.105c0,29.877-24.214,54.091-54.084,54.091H133.594c-29.877,0-54.091-24.214-54.091-54.091V160.591h83.717 
                                  c24.884,0,45.07-20.178,45.07-45.07V31.804h170.115c29.87,0,54.084,24.214,54.084,54.092V426.105z"/>
                                
                                <path class="st0" d="M178.002,297.743l21.051-30.701c1.361-2.032,2.032-4.07,2.032-6.109c0-5.027-3.938-8.965-9.37-8.965 
                                  c-3.394,0-6.11,1.494-8.281,4.754l-16.575,24.452h-0.265l-16.576-24.452c-2.172-3.26-4.888-4.754-8.281-4.754 
                                  c-5.432,0-9.37,3.938-9.37,8.965c0,2.039,0.67,4.077,2.031,6.109l20.919,30.701l-22.546,33.138 
                                  c-1.355,2.039-2.039,4.077-2.039,6.116c0,5.027,3.938,8.965,9.371,8.965c3.393,0,6.116-1.494,8.288-4.755l18.203-26.896h0.265 
                                  l18.203,26.896c2.171,3.261,4.894,4.755,8.287,4.755c5.432,0,9.37-3.938,9.37-8.965c0-2.039-0.677-4.078-2.039-6.116 
                                  L178.002,297.743z"/>
                                
                                <path class="st0" d="M291.016,251.968c-5.977,0-9.238,3.261-12.226,10.326l-19.284,44.547h-0.545l-19.697-44.547 
                                  c-3.121-7.066-6.382-10.326-12.358-10.326c-6.654,0-11.004,4.622-11.004,11.954v72.398c0,6.109,3.806,9.643,9.244,9.643 
                                  c5.153,0,8.958-3.534,8.958-9.643v-44.554h0.678l14.397,33.138c2.856,6.522,5.167,8.428,9.782,8.428 
                                  c4.615,0,6.927-1.906,9.782-8.428L283,291.766h0.684v44.554c0,6.109,3.666,9.643,9.098,9.643c5.432,0,9.098-3.534,9.098-9.643 
                                  v-72.398C301.88,256.59,297.67,251.968,291.016,251.968z"/>
                                
                                <path class="st0" d="M373.211,327.355h-32.873c-0.544,0-0.824-0.272-0.824-0.816V262.56c0-6.381-4.203-10.592-9.915-10.592 
                                  c-5.837,0-10.04,4.21-10.04,10.592v72.532c0,5.976,3.938,10.054,10.04,10.054h43.611c6.102,0,10.04-3.666,10.04-8.965 
                                  C383.251,331.02,379.313,327.355,373.211,327.355z"/>
                              </g>
                            </g>
                          </svg>
                          
                      </div>
                      
                    <h3 class="text-xl font-semibold mb-2">Site Map Generation</h3>
                    <p class="text-gray-600 dark:text-gray-400">Create comprehensive site maps for your website with visual hierarchy and structure.</p>
                </div>
                <!-- Feature 2 -->
                <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-[var(--secondary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path d="M13 11L21.2 2.80005" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M22 6.8V2H17.2" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                          </svg>
                          
                      </div>
                    <h3 class="text-xl font-semibold mb-2">URL Export</h3>
                    <p class="text-gray-600 dark:text-gray-400">Download a complete list of all URLs on your website in CSV format for easy analysis.</p>
                </div>
                <!-- Feature 3 -->
                <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-[var(--secondary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                        <svg fill="#ffffff" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <rect id="Icons" x="-384" y="-64" width="1280" height="800" style="fill:none;"></rect>
                              <g id="Icons1" serif:id="Icons">
                                <style type="text/css"> .st0{fill:#ffffff;} </style>
                                <path id="unlink" class="st0" d="M25.756,24.135l-13.108,-13.108l3.096,-3.097l39.854,39.853l-3.097,3.097l-13.663,-13.663c-0.479,5.948 -6.655,10.643 -11.677,15.608c-2.086,2.008 -4.942,3.152 -7.842,3.134c-8.317,-0.154 -14.619,-11.624 -7.763,-18.739c3.923,-3.972 7.61,-8.964 11.931,-10.816c0.338,-0.145 0.681,-0.268 1.029,-0.371c0.015,1.283 0.123,2.918 0.495,4.281c-0.701,0.282 -1.357,0.69 -1.934,1.232c-4.472,4.311 -10.909,8.453 -10.504,13.891c0.257,3.45 3.395,6.412 6.969,6.389c1.757,-0.032 3.469,-0.744 4.733,-1.96c5.086,-5.028 12.486,-10.213 9.87,-16.114c-0.516,-1.163 -1.387,-2.1 -2.445,-2.767c-0.079,-0.341 -0.154,-0.718 -0.216,-1.122l-2.133,-2.134c0.011,0.79 0.181,1.593 0.543,2.409c0.515,1.162 1.386,2.1 2.445,2.767c0.279,1.209 0.513,2.876 0.268,4.562c-3.992,-1.537 -7.263,-5.189 -7.43,-9.714c-0.047,-1.259 0.166,-2.461 0.579,-3.618Zm4.438,-6.578c2.066,-2.197 4.485,-4.319 6.683,-6.492c2.086,-2.009 4.942,-3.153 7.842,-3.135c8.317,0.155 14.62,11.625 7.763,18.74c-2.155,2.182 -4.239,4.672 -6.396,6.78l-3.025,-3.026c4.138,-3.653 8.749,-7.343 8.405,-11.971c-0.257,-3.451 -3.396,-6.412 -6.97,-6.39c-1.757,0.033 -3.469,0.744 -4.732,1.96c-2.124,2.1 -4.651,4.226 -6.683,6.421l-2.887,-2.887Z"/>
                              </g>
                            </g>
                          </svg>
                          
                      </div>
                    <h3 class="text-xl font-semibold mb-2">404 Error Detection</h3>
                    <p class="text-gray-600 dark:text-gray-400">Identify and fix broken links with our comprehensive 404 error detection system.</p>
                </div>
                <!-- Feature 4 -->
                <div class="card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-[var(--secondary)] bg-opacity-20 rounded-lg flex items-center justify-center mb-4 p-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path d="M1.99984 5.75C1.99984 5.33579 2.33562 5 2.74984 5H21.2498C21.664 5 21.9998 5.33579 21.9998 5.75C21.9998 6.16421 21.664 6.5 21.2498 6.5H2.74984C2.33562 6.5 1.99984 6.16421 1.99984 5.75ZM1.99984 12.25C1.99984 11.8358 2.33562 11.5 2.74984 11.5H21.2498C21.664 11.5 21.9998 11.8358 21.9998 12.25C21.9998 12.6642 21.664 13 21.2498 13H2.74984C2.33562 13 1.99984 12.6642 1.99984 12.25ZM18.9998 18.75C18.9998 18.3358 19.3356 18 19.7498 18H21.2498C21.664 18 21.9998 18.3358 21.9998 18.75C21.9998 19.1642 21.664 19.5 21.2498 19.5H19.7498C19.3356 19.5 18.9998 19.1642 18.9998 18.75Z" fill="#ffffff"/>
                              <path d="M2.41586 18.7377C2.62651 18.5972 2.83038 18.4376 3.02319 18.2633V22.25C3.02319 22.6642 3.35898 23 3.77319 23C4.18741 23 4.52319 22.6642 4.52319 22.25V15.75C4.52319 15.356 4.21942 15.033 3.83332 15.0024C3.46457 14.9719 3.12113 15.2183 3.03989 15.5897C2.91329 16.1684 2.34817 16.98 1.58381 17.4896C1.23916 17.7194 1.14603 18.185 1.3758 18.5297C1.60556 18.8743 2.07121 18.9674 2.41586 18.7377Z" fill="#ffffff"/>
                              <path d="M7.99976 17.5227C7.99976 16.995 8.44328 16.5 8.98552 16.5C9.39269 16.5 9.72045 16.6909 9.87891 16.9345C10.0148 17.1434 10.0963 17.4998 9.78534 18.0292C9.63583 18.2837 9.4098 18.5114 9.10378 18.7531C8.95132 18.8735 8.78821 18.9904 8.61083 19.1158L8.53705 19.1679C8.38482 19.2753 8.22186 19.3902 8.06445 19.5087C7.32083 20.0683 6.49976 20.8536 6.49976 22.25C6.49976 22.6642 6.83554 23 7.24976 23L7.25793 23L7.26611 23H10.7003C11.1145 23 11.4503 22.6642 11.4503 22.25C11.4503 21.8358 11.1145 21.5 10.7003 21.5H8.18741C8.34819 21.2182 8.61035 20.9752 8.96639 20.7072C9.10386 20.6038 9.24576 20.5036 9.39901 20.3955L9.47661 20.3407C9.6552 20.2145 9.84692 20.0775 10.0335 19.9302C10.4055 19.6364 10.7942 19.2731 11.0787 18.789C11.6356 17.8411 11.625 16.868 11.1363 16.1166C10.6701 15.4 9.84073 15 8.98552 15C7.50797 15 6.49976 16.2777 6.49976 17.5227C6.49976 17.9369 6.83554 18.2727 7.24976 18.2727C7.66397 18.2727 7.99976 17.9369 7.99976 17.5227Z" fill="#ffffff"/>
                              <path d="M14.4709 17.1377C14.5029 17.0255 14.5792 16.8666 14.7218 16.7409C14.8502 16.6276 15.0773 16.5 15.4997 16.5C16.261 16.5 16.4997 17.0002 16.4997 17.2273C16.4997 17.4724 16.4474 17.7178 16.3099 17.8907C16.1986 18.0308 15.9313 18.25 15.208 18.25C14.7938 18.25 14.458 18.5858 14.458 19C14.458 19.4142 14.7938 19.75 15.208 19.75C15.4815 19.75 15.8594 19.7864 16.1424 19.9191C16.2743 19.9809 16.3569 20.0505 16.4069 20.1207C16.4517 20.1837 16.4997 20.287 16.4997 20.4773C16.4997 20.965 16.3475 21.1807 16.2191 21.2891C16.068 21.4167 15.8237 21.5 15.4997 21.5C15.1377 21.5 14.9328 21.4374 14.8072 21.3578C14.6958 21.2873 14.5675 21.1538 14.4621 20.8338C14.3327 20.4403 13.9087 20.2263 13.5153 20.3558C13.1218 20.4852 12.9078 20.9092 13.0373 21.3026C13.2236 21.8689 13.5328 22.3263 14.0048 22.6252C14.4624 22.9149 14.9867 23 15.4997 23C16.0507 23 16.6815 22.8618 17.1866 22.4353C17.7145 21.9898 17.9997 21.3191 17.9997 20.4773C17.9997 20.0027 17.8699 19.5891 17.6285 19.2504C17.5499 19.14 17.4628 19.0423 17.3706 18.9559C17.4102 18.9135 17.4481 18.8695 17.4842 18.8241C17.9221 18.2731 17.9997 17.6321 17.9997 17.2273C17.9997 16.1543 17.0718 15 15.4997 15C14.7343 15 14.1483 15.2466 13.7295 15.616C13.325 15.9728 13.1202 16.4048 13.0285 16.7259C12.9148 17.1242 13.1455 17.5393 13.5438 17.653C13.9421 17.7667 14.3572 17.536 14.4709 17.1377Z" fill="#ffffff"/>
                            </g>
                          </svg>
                          
                      </div>
                    <h3 class="text-xl font-semibold mb-2">Link Counter</h3>
                    <p class="text-gray-600 dark:text-gray-400">Track the total number of internal and external links present on each page of your website.</p>
                </div>
            </div>
        </section>
    <h2 class="text-xl sm:text-2xl font-bold mb-8 text-center">About Us</h2>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <p class="text-gray-600 dark:text-gray-400 text-center">
            Welcome to SiteMonitor, your ultimate tool for analyzing and optimizing your website's structure. Our mission is to provide you with the insights and tools you need to improve your online presence and ensure a seamless user experience.
        </p>
    </div>
</section>
   
    </main>

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
        // Theme Toggle Functionality
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
        
        // Analyze Website Button
// Main analysis function
document.getElementById('analyze-btn').addEventListener('click', function() {
    const urlInput = document.getElementById('website-url');
    const url = urlInput.value.trim();
    
    if (!url) {
        alert('Please enter a valid URL');
        return;
    }
    
    // Show loading spinner
    this.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    showProgressBar();
    updateProgressBar(10); // Start progress

    // Make API request
    fetch('/site-checker?site=' + encodeURIComponent(url))
    .then(response => {
        updateProgressBar(50); // Midway progress
        return response.json();
    })
    .then(data => {
        updateProgressBar(100); // Complete progress
        setTimeout(hideProgressBar, 500); // Hide after a short delay

        console.log(data);
        this.innerHTML = 'Analyze Website';
        // document.getElementById('pre-analysis-info').classList.add('hidden');
        const analysisResults = document.getElementById('analysis-results');

        // Get tab elements
        const sitemapTab = document.getElementById('sitemap-tab');
        const urlsTab = document.getElementById('urls-tab');
        const errorsTab = document.getElementById('errors-tab');

        // Clear existing content
        sitemapTab.querySelector('.sitemap-visualization').innerHTML = '';
        urlsTab.querySelector('tbody').innerHTML = '';
        errorsTab.querySelector('.space-y-4').innerHTML = '';

        // Populate sitemap visualization
        if (data.saved_to) {
        const url1 = new URL(url);
        const hostname = url1.hostname;
            fetch('/sitemaps/'+hostname+'-sitemap.xml')
                .then(response => response.json())
                .then(sitemapData => {
                    sitemapData.visited_urls.forEach(item => {
                        // if(data.error_pages.includes(item)){
                        //   return;
                        // }
                        const sitemapItem = document.createElement('div');
                        sitemapItem.classList.add('result-item');
                        sitemapItem.innerHTML = `
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[var(--secondary)]"></div>
                                <div class="ml-2 break-all">${item}</div>
                            </div>
                        `;
                        sitemapTab.querySelector('.sitemap-visualization').appendChild(sitemapItem);
                    });
                })
                .catch(error => {
                    console.error('Error fetching sitemap:', error);
                    // Fallback to showing crawled URLs
                    data.visited_urls.forEach(item => {
                //         if(inarray(item, data.error_pages)){
                //     return;
                // }
                        const sitemapItem = document.createElement('div');
                        sitemapItem.classList.add('result-item');
                        sitemapItem.innerHTML = `
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[var(--secondary)]"></div>
                                <div class="ml-2 break-all">${item}</div>
                            </div>
                        `;
                        sitemapTab.querySelector('.sitemap-visualization').appendChild(sitemapItem);
                    });
                });
        } else {
            // If no sitemap URL, show crawled URLs
             document.querySelector('#urls-tab h3').textContent = `All URLs (${ data.visited_urls} found)`;
            data.visited_urls.forEach(item => {
                // if(data.error_pages.includes(item)){
                //           return;
                //         }
                const sitemapItem = document.createElement('div');
                sitemapItem.classList.add('result-item');
                sitemapItem.innerHTML = `
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-[var(--secondary)]"></div>
                        <div class="ml-2 break-all">${item}</div>
                    </div>
                `;
                sitemapTab.querySelector('.sitemap-visualization').appendChild(sitemapItem);
            });
        }

        // Populate URLs table
        data.visited_urls.forEach(url => {
    // Uncomment if dynamic status handling is needed
    // let urlStatus;
    // if (data.error_pages.includes(url)) {
    //     urlStatus = '<div class="text-red-700 dark:text-red-400 font-medium">404 Not Found</div>';
    // } else {
    //     urlStatus = '<span class="px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">200 OK</span>';
    // }

    const urlRow = document.createElement('tr');
    var width=analysisResults
    urlRow.style.width = width;
    urlRow.style.overflowX = 'auto';
    urlRow.classList.add('result-item');
    urlRow.innerHTML = `
        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm break-all" style="width: 60%; overflow-x: auto;">${url}</td>
        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm" style="width: 20%; overflow-x: auto;">N/A</td>
        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm" style="width: 20%; overflow-x: auto;">
            <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">200 OK</span>
        </td>
    `;
    urlsTab.querySelector('tbody').appendChild(urlRow);
});


        // Populate 404 errors
        data.error_pages.forEach(error => {
            const errorItem = document.createElement('div');
            errorItem.classList.add('result-item', 'bg-red-50', 'dark:bg-red-900/20', 'border', 'border-red-200', 'dark:border-red-800/30', 'rounded-lg', 'p-4');
            errorItem.innerHTML = `
                <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                    <div>
                        <div class="font-medium text-red-700 dark:text-red-400 break-all">${error.url}</div>
                        <div class="text-sm text-red-600 dark:text-red-300 mt-1 break-all">Referenced from: ${error.referencedFrom || 'N/A'}</div>
                    </div>
                    <div class="text-red-700 dark:text-red-400 font-medium">404 Not Found</div>
                </div>
            `;
            errorsTab.querySelector('.space-y-4').appendChild(errorItem);
        });
        document.querySelector('#errors-tab h3').textContent = `404 Errors (${data.error_pages.length} found)`;
        
        // Show results
        analysisResults.classList.remove('hidden');
        analysisResults.classList.add('fade-in');
        analysisResults.scrollIntoView({ behavior: 'smooth' });

        // Setup download functionality
        setupDownloads(data);
    })
    .catch(error => {
        hideProgressBar();
        this.innerHTML = 'Analyze Website';
        console.error('API error:', error);
        alert('Something went wrong. Please try again.');
    });
});

// Download functionality
function setupDownloads(data) {
    // Remove existing event listeners to avoid duplicates
    document.getElementById('download-sitemap').removeEventListener('click', downloadSitemap);
    document.getElementById('download-urls').removeEventListener('click', downloadUrls);
    document.getElementById('download-errors').removeEventListener('click', downloadErrors);
    
    // Add new event listeners
    document.getElementById('download-sitemap').addEventListener('click', downloadSitemap);
    document.getElementById('download-urls').addEventListener('click', downloadUrls);
    document.getElementById('download-errors').addEventListener('click', downloadErrors);

    // Generate sitemap download
    async function downloadSitemap() {
        try {
            const sitemapContent = await generateSitemapFromUrl(data.sitemapUrl || document.getElementById('website-url').value.trim());
            downloadFile('sitemap.xml', sitemapContent);
        } catch (error) {
            console.error('Error generating sitemap:', error);
            alert('Failed to generate sitemap download');
        }
    }

    // Generate URLs CSV download
    function downloadUrls() {
        const csvContent = generateUrlsCsv(data);
        downloadFile('urls.csv', csvContent);
    }

    // Generate 404 errors CSV download
    function downloadErrors() {
        const csvContent = generate404Csv(data);
        downloadFile('404-errors.csv', csvContent);
    }
}

// Helper functions for generating download content
async function generateSitemapFromUrl(sitemapUrl) {
    try {
        // Try to fetch actual sitemap if available
        // alert(sitemapUrl);
        const url = new URL(sitemapUrl);
        const hostname = url.hostname;
        // alert(hostname);
        if (true) {
            const response = await fetch('/sitemaps/'+hostname+'-sitemap.xml');
            const xmlText = await response.text();
            return xmlText; // Return original sitemap if available
        }
        
        // Fallback: generate basic sitemap from visited URLs
        let sitemapString = `<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n`;
        const visitedUrls = Array.from(new Set(data.visited_urls)); // Remove duplicates
        
        visitedUrls.forEach(url => {
            sitemapString += `  <url>\n    <loc>${url}</loc>\n  </url>\n`;
        });
        
        sitemapString += `</urlset>`;
        return sitemapString;
    } catch (error) {
        console.error("Failed to generate sitemap:", error);
        throw error;
    }
}

function generateUrlsCsv(data) {
    let csvContent = "URL,Status\n";
    data.visited_urls.forEach(url => {
        csvContent += `${url},200 OK\n`;
    });
    return csvContent;
}

function generate404Csv(data) {
    let csvContent = "URL,Referenced From,Status\n";
    data.error_pages.forEach(error => {
        csvContent += `${error.url},${error.referencedFrom || 'N/A'},404 Not Found\n`;
    });
    return csvContent;
}

function downloadFile(filename, content) {
    if (!content) {
        console.error("No content to download");
        alert("Failed to generate download content");
        return;
    }
    
    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

//  }
    </script>
<script>
function displayAnalysisResults(data) {
    // Show the results section
    document.getElementById('analysis-results').classList.remove('hidden');
    document.getElementById('sitemap-tab').classList.add('hidden');
    
    // Populate Sitemap tab
    // populateSitemap(data.sitemap);
    
    // Populate URLs tab
    populateAllUrls(data.working);
    
    // Populate Errors tab
    populateErrors(data.errors);
    closePopup();
}
function populateAllUrls(urlsData) {
    const tbody = document.querySelector('#urls-tab tbody');
    tbody.innerHTML = ''; // Clear existing content
     document.querySelector('#urls-tab').classList.remove('hidden');
    document.querySelector('#sitemap-tab').classList.add('hidden');
    document.querySelector('#errors-tab').classList.add('hidden');
    document.querySelector('#sitemap-tab-btn').classList.add('hidden');
    if (!urlsData || urlsData.length === 0) return;
    
    // Update count in heading
    document.querySelector('#urls-tab h3').textContent = `All URLs (${urlsData.length} found)`;
    
    urlsData.forEach(url => {
        const row = document.createElement('tr');
        row.className = 'result-item';
        
        const statusClass = url.status === 200 ? 
            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
        
        row.innerHTML = `
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm break-all">${url.url}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm">${url.lastModified || 'N/A'}</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm">
                <span class="px-2 py-1 rounded-full ${statusClass}">${url.status} ${getStatusText(url.status)}</span>
            </td>
        `;
        tbody.appendChild(row);
    });
   
}

function populateErrors(errorsData) {
    const container = document.querySelector('#errors-tab .space-y-4');
    container.innerHTML = ''; // Clear existing content
    
    if (!errorsData || errorsData.length === 0) return;
    
    // Update count in heading
    document.querySelector('#errors-tab h3').textContent = `404 Errors (${errorsData.length} found)`;
    
    errorsData.forEach(error => {
        const element = document.createElement('div');
        element.className = 'result-item bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 rounded-lg p-4';
        element.innerHTML = `
            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                <div>
                    <div class="font-medium text-red-700 dark:text-red-400 break-all">${error.url}</div>
                    ${error.referrer ? `<div class="text-sm text-red-600 dark:text-red-300 mt-1 break-all">Referenced from: ${error.referrer}</div>` : ''}
                </div>
                <div class="text-red-700 dark:text-red-400 font-medium">${error.status || 404} Not Found</div>
            </div>
        `;
        container.appendChild(element);
    });
}

function getStatusText(statusCode) {
    const statusTexts = {
        200: 'OK',
        301: 'Moved Permanently',
        302: 'Found',
        404: 'Not Found',
        500: 'Server Error'
    };
    return statusTexts[statusCode] || '';
}

// Example usage with your data:
// displayAnalysisResults(af.data);

// Modify your existing form submit handler to use this:
document.getElementById('upload-excel-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    try {
        showProgressBar();
        updateProgressBar(10); // Start progress

        const response = await fetch(this.action, {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Failed to upload and analyze the file.');
        }

        updateProgressBar(70); // Midway progress
        const result = await response.json();

        updateProgressBar(100); // Complete progress
        setTimeout(hideProgressBar, 500); // Hide after a short delay

        // Assuming the server returns data in the format we need
        displayAnalysisResults(result);
    document.getElementById('download-urls').removeEventListener('click', downloadUrls1);
    document.getElementById('download-errors').removeEventListener('click', downloadErrors1);
    
    // Add new event listeners
    document.getElementById('download-urls').addEventListener('click', downloadUrls1);
    document.getElementById('download-errors').addEventListener('click', downloadErrors1);
    function downloadUrls1() {
        const csvContent = generateUrlsCsv1(result);
        downloadFile('urls.csv', csvContent);
    }
    function downloadErrors1() {
        const csvContent = generate404Csv1(result);
        downloadFile('404-errors.csv', csvContent);
    }
        // Show the analysis results
        
        
    } catch (error) {
        console.error(error);
        alert('An error occurred while processing the file.');
        hideProgressBar();
    }
});
function generateUrlsCsv1(data) {
    let csvContent = "URL,Status\n";
    data.working.forEach(url => {
        csvContent += `${url.url},${url.status}\n`;
    });
    return csvContent;
}
function generate404Csv1(data) {
    let csvContent = "URL,Referenced From,Status\n";
    data.errors.forEach(error => {
        csvContent += `${error.url},${error.referrer || 'N/A'},${error.status || 404}\n`;
    });
    return csvContent;
}
</script>

<script>
    function openPopup() {
        document.getElementById('uploadPopup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('uploadPopup').style.display = 'none';
        document.getElementById('fileName').textContent = '';
        document.getElementById('fileBtn').textContent = 'Browse File';
        document.getElementById('fileInput').value = ''; // reset file input
    }

    function triggerFile() {
        document.getElementById('fileInput').click();
    }

    function handleDrop(event) {
        event.preventDefault();
        const file = event.dataTransfer.files[0];
        handleFile(file);
    }

    function handleFile(file) {
        if (!file) return;

        

        document.getElementById('fileName').textContent = `Selected File: ${file.name}`;
        document.getElementById('fileBtn').textContent = 'Check File';
        document.getElementById('fileBtn').type = 'submit'; // Change button type to prevent form submission
        document.getElementById('fileBtn').onclick=''; // Reset file input click event
        

        console.log('File accepted:', file);
        // You can process file here
    }
    function showProgressBar() {
            document.getElementById('progress-bar-container').style.display = 'block';
        }
        
        function hideProgressBar() {
            document.getElementById('progress-bar-container').style.display = 'none';
        }
        
        function updateProgressBar(percent) {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = percent + '%';
        }
    
</script>


<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93c98a3f55c346ae',t:'MTc0NjcxMzQyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><iframe height="1" width="1" style="position: absolute; top: 0px; left: 0px; border: none; visibility: hidden;"></iframe>
</body></html>