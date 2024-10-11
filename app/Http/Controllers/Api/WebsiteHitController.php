<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteHitController extends Controller
{
    public function generateScript($id)
    {
        $website = Website::find($id);
    
        $script = "
        <script>
            (function() {
                document.addEventListener('DOMContentLoaded', function() {
                    var currentUrl = window.location.pathname;
                    if (currentUrl === '{$website->path}') {
                        // Hit the API on your Laravel app
                        fetch('http://127.0.0.1:8000/api/hit-url', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ domain: '{$website->domain}', path: '{$website->path}' })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.content) {
                                var container = document.getElementById('dynamic-content');
                                if (container) {
                                    container.innerHTML = data.content;
                                }
                            }
                        })
                        .catch(err => console.error('Error fetching content:', err));
                    }
                });
            })();
        </script>
        ";
    
        return response($script, 200)->header('Content-Type', 'text/javascript');
    }
    
    public function hitUrl(Request $request) {
        // Validate request
        $request->validate([
            'url' => 'required|url',
            'website' => 'required|string',
        ]);
    
        // Find the website based on the domain
        $website = Website::where('domain', $request->website)->firstOrFail();
    
        // Return the dynamic content
        return response()->json(['content' => $website->content]);
    }
    
}
