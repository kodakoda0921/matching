<?php
namespace App\Repositories\Languages;

use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Models\Languages;

class LanguagesRepository implements LanguagesRepositoryInterface
{
    public function __construct(Languages $languages)
    {
        $this->languages = $languages;
    }

    public function getLanguagesList()
    {
        $result = $this->languages->get();
        return $result;
    }
}
