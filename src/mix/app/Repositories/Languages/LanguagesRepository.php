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

    /**
     * 言語リストの取得
     * 
     * @return $result
     */
    public function getLanguagesList()
    {
        $result = $this->languages->get();
        return $result;
    }

    /**
     * 言語の取得
     * 
     * @param int $language_id
     * @return $result
     */
    public function view($language_id)
    {
        $result = $this->languages->find($language_id);
        return $result;
    }
}
