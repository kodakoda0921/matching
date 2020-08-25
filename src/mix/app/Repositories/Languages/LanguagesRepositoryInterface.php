<?php
namespace App\Repositories\Languages;

interface LanguagesRepositoryInterface
{
    /**
     * 言語リストの取得
     * 
     * @return $result
     */
    public function getLanguagesList();

    /**
     * 言語の取得
     * 
     * @param int $language_id
     * @return $result
     */
    public function view($language_id);
}

