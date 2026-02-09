<?php

namespace App\Http\Controllers; 

use App\Models\Url;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlGenerateController extends Controller
{
        public function index(Url $url = null)
        {
            $user = Auth::user();
            $urls = Url::latest();

            if($user->role == "Admin"){
                $urls = Url::where('company_id',$user->company_id);
            }

            if($user->role == "Member"){
                $urls = Url::where('user_id',$user->id);
            }

            $urls = $urls->get();
            
            return view('urls.index', compact('urls', 'url'));
        }


        public function save(Request $request, Url $url = null)
        {
            $request->validate([
                'url'        => 'required|url',
            ]);

            Url::updateOrCreate(
                ['id' => $url?->id],
                [
                    'user_id'    => Auth::id(),
                    'company_id' => Auth::user()->company_id,
                    'url'        => $request->url,
                    'short_url'  => $url?->short_url ?? $this->generateShortUrl(),
                ]
            );

            return redirect()->route('urls.index');
        }

        public function delete(Url $url)
        {
            $url->delete();

            return redirect()->route('urls.index')->with('success', 'URL deleted successfully');
        }

        private function generateShortUrl(int $length = 6): string
        {
            do {
                $shortUrl = Str::random($length);
            } while (Url::where('short_url', $shortUrl)->exists());

            return $shortUrl;
        }

        public function redirect($shortUrl)
        {
            $url = Url::where('short_url', $shortUrl)->first();

            if (!$url) {
                abort(404);
            }

            return redirect()->away($url->url);
        }
    }
