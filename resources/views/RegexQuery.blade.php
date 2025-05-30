@extends('layouts.Index')
@section('content')
 <main class="container mx-auto px-4 py-8">
 <section class="mb-16">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 transition-all">
                <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center">Enter Your Website URL And Regex Pattern</h2>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <input type="text" id="website-url" placeholder="https://example.com" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                     <input onkeyup="onkeyupevent(event);" type="text" id="regex-pattern" placeholder="Enter your regex pattern" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                    <button id="analyze-btn" class="btn bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white px-6 py-3 rounded-lg font-medium shadow-md hover:shadow-lg">
                        Check Regex
                    </button>
                   
                </div>
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                    We'll scan your website and generate a complete analysis of the regex pattern.
                </div>
                
            </div>
        </section>
         <section class="mb-16">
          <div class="loader-container hidden" id="loader-container">
        <div class="circle-wrapper">
            <div class="outer-ring"></div>
            <div class="middle-ring"></div>
            <div class="inner-circle">
                <span id="percentage">100%</span>
            </div>
            <div class="dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>    
        <h2 class="status-text">Analyzing your site</h2>
         <div class="time-display" id="time-display">00:00</div>
        {{-- <p class="detail-text" id="current-task">Generating detailed recommendations...</p> --}}
        <div class="progress-bar">
            <div class="progress-fill" style="width: 100%;"></div>
        </div>
    </div>
        </section>
        <section id="results" class="hidden">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 transition-all">
                <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center">Regex Analysis Results</h2>
                <div id="results-content" class="text-gray-800 dark:text-gray-200"></div>
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
 </main>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const analyzeBtn = document.getElementById('analyze-btn');
    const resultsSection = document.getElementById('results');
    const resultsContent = document.getElementById('results-content');

    analyzeBtn.addEventListener('click', function() {
        const websiteUrl = document.getElementById('website-url').value;
        const regexPattern = document.getElementById('regex-pattern').value;

        if (websiteUrl && regexPattern) {
            // Show loading state
            analyzeBtn.disabled = true;
            analyzeBtn.innerHTML = 'Analyzing...';
             updateProgress = startAnimatedProgress();
            initiateCustomTimer();
            // for(var i=1;i<=10;i++){    
            // updateDisplay(i); // Start at 10%
            // await new Promise(resolve => setTimeout(resolve, 1));
            // }
             let i = 1;
        const interval = setInterval(() => {
            if (i > 10) {
                clearInterval(interval); // Stop the loop
                return;
            }

          updateDisplay(i); // Start at 10%
            i++;
        }, 100); // 100ms delay
            fetch('/check-urls-regx-result?url=' + encodeURIComponent(websiteUrl) + '&regex=' + encodeURIComponent(regexPattern) +'&depth=5', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
               let i = 10;
        const interval = setInterval(() => {
            if (i > 50) {
                clearInterval(interval); // Stop the loop
                return;
            }

          updateDisplay(i); // Start at 10%
            i++;
        }, 100); 
                analyzeBtn.disabled = false;
                analyzeBtn.innerHTML = 'Check Regex';
                
                if (data.status === 'success') {
                    // Convert matches object to array
             let i = 50;
        const interval = setInterval(() => {
            if (i > 100) {
                clearInterval(interval); // Stop the loop
                return;
            }

          updateDisplay(i); // Start at 10%
            i++;
        }, 100); 
        setTimeout(() => {
                    document.getElementById('loader-container').classList.add('hidden');
                    const matchesArray = data.results.matches ? Object.keys(data.results.matches).map(key => ({
                        url: key,
                        match_count: data.results.matches[key].match_count,
                        sample_matches: data.results.matches[key].matches
                    })) : [];
                    
                    // Sort by match count (descending)
                    matchesArray.sort((a, b) => b.match_count - a.match_count);

                    let matchesHtml = '<li>No matches found.</li>';
                    
                    if (matchesArray.length > 0) {
                        matchesHtml = matchesArray.map(match => 
                            `<li class="mb-3">
                                <div class="flex items-baseline">
                                    <span class="font-medium break-all">${match.url}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                                        (${match.match_count} ${match.match_count === 1 ? 'match' : 'matches'})
                                    </span>
                                </div>
                                ${match.sample_matches.length > 0 ? 
                                    `<div class="text-xs text-gray-500 dark:text-gray-400 ml-2 rounded">
                                        <strong>Sample matches:</strong>
                                        <ul class="list-disc pl-4 mt-1">
                                            ${match.sample_matches.slice(0, 3).map(sample => 
                                                `<li class="truncate">${escapeHtml(sample)}</li>`
                                            ).join('')}
                                        </ul>
                                    </div>` : ''
                                }
                            </li>`
                        ).join('');
                    }

                    resultsContent.innerHTML = `
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Regex Analysis Summary</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Scanned URL</p>
                                    <p class="font-medium break-all">${escapeHtml(websiteUrl)}</p>
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Regex Pattern</p>
                                    <p class="font-mono">${escapeHtml(regexPattern)}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <h4 class="text-md font-semibold mb-3">Matched URLs (${data.results.pages_with_matches || 0} total matches)</h4>
                            <ul class="list-disc pl-5 space-y-3">
                                ${matchesHtml}
                            </ul>
                        </div>
                    `;
                    resultsSection.classList.remove('hidden');
                    }, 7000); // 2000ms = 2 seconds
                } else {
                    document.getElementById('loader-container').classList.add('hidden');
                    showError(data.message || 'An error occurred during analysis.');
                }
            })
            .catch(error => {
                document.getElementById('loader-container').classList.add('hidden');
                console.error('Error:', error);
                analyzeBtn.disabled = false;
                analyzeBtn.innerHTML = 'Check Regex';
                showError('An error occurred while fetching the results.');
            });
        } else {
            alert('Please enter both a URL and a regex pattern.');
        }
    });

    function showError(message) {
        resultsContent.innerHTML = `
            <div class="text-center py-8">
                <p class="text-red-500 dark:text-red-400 font-medium">${escapeHtml(message)}</p>
            </div>
        `;
        resultsSection.classList.remove('hidden');
    }

    function escapeHtml(unsafe) {
        if (!unsafe) return '';
        return unsafe.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});
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
        function startAnimatedProgress() {
    const tasks = [
        "Initializing comprehensive analysis...",
        "Scanning site architecture and structure...",
        "Analyzing page load performance metrics...",
        "Evaluating SEO factors and opportunities...",
        "Checking mobile responsiveness across devices...",
        "Auditing security protocols and vulnerabilities...",
        "Analyzing user experience metrics...",
        "Generating detailed recommendations..."
    ];

    const percentageText = document.getElementById('percentage');
    const progressFill = document.querySelector('.progress-fill');
    const currentTaskText = document.getElementById('current-task');
    const pagesScanned = document.getElementById('pages-scanned');
    const issuesFound = document.getElementById('issues-found');
    const optimization = document.getElementById('optimization');

    document.getElementById('loader-container').classList.remove('hidden');
    let currentTask = 0;
    let pages = 0;
    let issues = 0;
    let optimizationValue = 0;

    // Update progress display
    
    function updateDisplay(progress) {
        percentageText.textContent = `${progress}%`;
        progressFill.style.width = `${progress}%`;

        // Update task text based on progress
        const taskIndex = Math.min(Math.floor(progress / (100 / tasks.length)), tasks.length - 1);
        if (taskIndex !== currentTask) {
            currentTask = taskIndex;
            // currentTaskText.textContent = tasks[currentTask];
        }

        // Simulate scanning metrics
        // if (progress % 5 === 0) {
        //     pages = Math.min(pages + Math.floor(Math.random() * 3) + 1, progress * 2);
        //     pagesScanned.textContent = pages;

        //     if (progress % 10 === 0) {
        //         issues = Math.min(issues + Math.floor(Math.random() * 2) + 1, Math.floor(progress / 2));
        //         issuesFound.textContent = issues;
        //     }

        //     optimizationValue = Math.min(Math.floor(progress * 0.8), 100);
        //     optimization.textContent = `${optimizationValue}%`;
        // }
    }

    // Start with 0 progress
    updateDisplay(0);

    // Return a function to update progress from external calls
    return function(progress) {
        currentProgress = Math.min(progress, maxProgress);
        updateDisplay(currentProgress);
        
        if (currentProgress >= 100) {
            // currentTaskText.textContent = "Analysis Complete!";
            clearInterval(progressInterval);
        }
    };
}

// Global progress updater function
let updateProgress;

        // Initialize progress when page loads
    // Start the countdown timer
function initiateCustomTimer() {
    customTimerStartTime = Date.now();
    customTimerInterval = setInterval(refreshCustomTimer, 1000);
    refreshCustomTimer(); // Update immediately
}

// Stop the countdown timer
function haltCustomTimer() {
    if (customTimerInterval) {
        clearInterval(customTimerInterval);
        customTimerInterval = null;
    }
    if (customProgressInterval) {
        clearInterval(customProgressInterval);
        customProgressInterval = null;
    }
}

// Initialize tracking variables
let customTimerStartTime = null;
let customTimerInterval = null;
let customProgressInterval = null;

// Format seconds into MM:SS
function getFormattedCustomTime(totalSeconds) {
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

// Update the time display element
function refreshCustomTimer() {
    if (customTimerStartTime) {
        const now = Date.now();
        const timeElapsed = Math.floor((now - customTimerStartTime) / 1000);
        document.getElementById('time-display').textContent = getFormattedCustomTime(timeElapsed);
    }
}
 function updateDisplay(progress) {

     const percentageText = document.getElementById('percentage');
    const progressFill = document.querySelector('.progress-fill');
    const currentTaskText = document.getElementById('current-task');
    const pagesScanned = document.getElementById('pages-scanned');
    const issuesFound = document.getElementById('issues-found');
    const optimization = document.getElementById('optimization');
    
        percentageText.textContent = `${progress}%`;
        progressFill.style.width = `${progress}%`;
    }
function onkeyupevent(event) {
    if (event.keyCode === 13 || event.which === 13) {
        document.getElementById("analyze-btn").click();
    }
}
</script>
@endsection
