<?php

namespace App\Http\Controllers;

use App\Models\MagazinePost;
use Artesaos\SEOTools\Facades\SEOTools;

class MagazineController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Luxuri Magazine - Luxury Travel & Living');
        SEOTools::setDescription('Discover curated insights on luxury travel, refined living, and exclusive experiences.');
        SEOTools::opengraph()->setUrl(url('/magazine'));

        return view('magazine');
    }

    public function show(MagazinePost $magazinePost)
    {
        abort_unless($magazinePost->active, 404);

        SEOTools::setTitle($magazinePost->meta_title ?: $magazinePost->title . ' | Luxuri Magazine');
        SEOTools::setDescription($magazinePost->meta_description ?: $magazinePost->excerpt ?? '');
        SEOTools::opengraph()->setUrl(url("/magazine/{$magazinePost->slug}"));
        if ($magazinePost->featured_image) {
            SEOTools::opengraph()->addImage($magazinePost->featured_image);
        }

        return view('magazine-post', compact('magazinePost'));
    }
}
