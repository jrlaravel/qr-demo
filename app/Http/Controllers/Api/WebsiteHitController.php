<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteHitController extends Controller
{
    public function generateScript($id) {
        $website = Website::findOrFail($id);  // Find the website by ID
    
        // Generate a dynamic JavaScript snippet
        $script = <<<EOT
        <script>
        (function() {
            document.addEventListener('DOMContentLoaded', function() {
                var currentUrl = window.location.pathname;
                if (currentUrl === '{$website->path}') {
                    fetch('http://127.0.0.1:8000/api/hit-url', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ url: window.location.href, website: '{$website->domain}' })
                    })
                    .then(response => response.json())
                    .then(data => {
                        var container = document.getElementById('dynamic-content');
                        if (container) {
                            container.innerHTML = data.content;
                        }
                    })
                    .catch(err => console.error('Error fetching content:', err));
                }
            });
        })();
        </script>
        EOT;
    
        return response($script)->header('Content-Type', 'application/javascript');
    }
    
    public function handleUrlHit(Request $request) {
        $request->validate([
            'url' => 'required',
            'website' => 'required'
        ]);

        // Find the website based on the domain
        $website = Website::where('domain', $request->website)->firstOrFail();

        // Return the dynamic content
        return response()->json(['content' => $website->content]);
    }
}
