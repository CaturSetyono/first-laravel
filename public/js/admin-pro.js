/**
 * Admin Pro - Performance Optimized JavaScript
 * Handles preloader, page transitions, and optimizations
 */
(function() {
    'use strict';
    
    // Performance timing
    const perfStart = performance.now();
    
    // Remove preloader when page is fully loaded
    window.addEventListener('load', function() {
        const preloader = document.querySelector('.preloader-pro');
        if (preloader) {
            preloader.classList.add('loaded');
            setTimeout(function() {
                preloader.remove();
            }, 300);
        }
        
        // Add page transition class to content
        const content = document.querySelector('.content-wrapper');
        if (content) {
            content.classList.add('page-transition');
        }
        
        // Log performance
        const loadTime = performance.now() - perfStart;
        console.log('Page loaded in ' + loadTime.toFixed(2) + 'ms');
    });
    
    // Prefetch links on hover for faster navigation
    document.addEventListener('DOMContentLoaded', function() {
        // Cache DOM queries
        const links = document.querySelectorAll('a[href^="/"]');
        const prefetchedUrls = new Set();
        
        links.forEach(function(link) {
            link.addEventListener('mouseenter', function() {
                const href = this.getAttribute('href');
                if (href && !prefetchedUrls.has(href)) {
                    prefetchedUrls.add(href);
                    const prefetch = document.createElement('link');
                    prefetch.rel = 'prefetch';
                    prefetch.href = href;
                    document.head.appendChild(prefetch);
                }
            }, { once: true });
        });
        
        // Lazy load images with IntersectionObserver
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });
            
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
        
        // Debounce scroll events
        let scrollTimeout;
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) {
                window.cancelAnimationFrame(scrollTimeout);
            }
            scrollTimeout = window.requestAnimationFrame(function() {
                const st = window.pageYOffset || document.documentElement.scrollTop;
                lastScrollTop = st <= 0 ? 0 : st;
            });
        }, { passive: true });
        
        // Optimize table rendering for large datasets
        const tables = document.querySelectorAll('table');
        tables.forEach(function(table) {
            table.style.willChange = 'transform';
            table.style.contain = 'layout style paint';
        });
        
        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Preconnect to external resources
        const preconnectDomains = [
            'https://fonts.googleapis.com',
            'https://fonts.gstatic.com',
            'https://cdn.jsdelivr.net'
        ];
        
        preconnectDomains.forEach(function(domain) {
            if (!document.querySelector('link[rel="preconnect"][href="' + domain + '"]')) {
                const link = document.createElement('link');
                link.rel = 'preconnect';
                link.href = domain;
                link.crossOrigin = 'anonymous';
                document.head.appendChild(link);
            }
        });
        
        // Enable instant click for internal links (preload on mousedown)
        links.forEach(function(link) {
            link.addEventListener('mousedown', function(e) {
                if (e.button === 0) {
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('/') && !href.includes('#')) {
                        // Start loading the page
                        const preload = document.createElement('link');
                        preload.rel = 'preload';
                        preload.as = 'document';
                        preload.href = href;
                        document.head.appendChild(preload);
                    }
                }
            });
        });
    });
    
    // Optimize form inputs
    document.addEventListener('focusin', function(e) {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
            e.target.style.willChange = 'transform';
        }
    });
    
    document.addEventListener('focusout', function(e) {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
            e.target.style.willChange = 'auto';
        }
    });
})();
