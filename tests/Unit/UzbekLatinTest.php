<?php

namespace Tests\Unit;

use App\Support\UzbekLatin;
use PHPUnit\Framework\TestCase;

class UzbekLatinTest extends TestCase
{
    public function test_to_old_spells_out_every_new_letter(): void
    {
        $this->assertSame(
            'Oʻzbek yigʻilishi, Shahar va choy. Gʻalaba, Choʻl. Aʼzolar',
            UzbekLatin::toOld('Özbek yiğilişi, Şahar va çoy. Ğalaba, Çöl. Aʼzolar'),
        );
    }

    public function test_to_old_keeps_all_caps_words_in_caps(): void
    {
        $this->assertSame('SHAHAR CHOʻL', UzbekLatin::toOld('ŞAHAR ÇÖL'));
    }

    public function test_to_old_and_to_new_round_trip(): void
    {
        $text = 'Tokioda özbek tadqiqotçilarining yillik yiğilişi. Ğalaba!';

        $this->assertSame($text, UzbekLatin::toNew(UzbekLatin::toOld($text)));
    }
}
