<?php

return [
    'site' => [
        'name' => 'Uzbek Academic Club in Japan',
        'short_name' => 'UAC Japan',
        'domain' => 'uacjp.uz',
        'tagline' => [
            'en' => 'Connecting Uzbek scholars, researchers, and academic partners across Japan.',
            'uz' => 'Yaponiyadagi özbek olimlari, tadqiqotçilari va akademik hamkorlarini bir-biriga boğlaydi.',
            'ja' => '日本各地のウズベキスタン人研究者・学者・学術パートナーをつなぐ。',
        ],
        'description' => [
            'en' => 'A professional academic community platform for Uzbek students, researchers, alumni, and institutional partners in Japan.',
            'uz' => 'Yaponiyadagi özbek talabalari, tadqiqotçilari, bitiruvçilari va institutsional hamkorlari uçun professional akademik hamjamiyat platformasi.',
            'ja' => '日本在住のウズベキスタン人学生・研究者・卒業生・機関パートナーのための学術コミュニティプラットフォーム。',
        ],
        'founded' => '2024',
    ],

    // Top-level order is fixed by the navbar partial, not by this list; see
    // $topLevelOrder there. Members and Partners hang off the "About UAC" menu.
    'navigation' => [
        ['label' => ['en' => 'Home', 'uz' => 'Boş sahifa', 'ja' => 'ホーム'], 'route' => 'home'],
        ['label' => ['en' => 'About UAC', 'uz' => 'UAC haqida', 'ja' => 'UACについて'], 'route' => 'about'],
        ['label' => ['en' => 'News', 'uz' => 'Yangiliklar', 'ja' => 'ニュース'], 'route' => 'news.index'],
        ['label' => ['en' => 'Activities', 'uz' => 'Tadbirlar', 'ja' => '活動'], 'route' => 'activities'],
        ['label' => ['en' => 'Regions', 'uz' => 'Regionlar', 'ja' => '地域'], 'route' => 'regions.index'],
        ['label' => ['en' => 'Contact Us', 'uz' => 'Boğlaniş', 'ja' => 'お問い合わせ'], 'route' => 'contact'],
        ['label' => ['en' => 'Members', 'uz' => 'Aʼzolar', 'ja' => 'メンバー'], 'route' => 'members.index'],
        ['label' => ['en' => 'Partners', 'uz' => 'Hamkorlar', 'ja' => 'パートナー'], 'route' => 'partners'],
        ['label' => ['en' => 'Join Us', 'uz' => 'Aʼzo böliş', 'ja' => '参加する'], 'route' => 'join'],
    ],

    'hero_stats' => [
        ['label' => ['en' => 'Regions', 'uz' => 'Regionlar', 'ja' => '地域'], 'value' => '5'],
        ['label' => ['en' => 'Academic Fields', 'uz' => 'Ilmiy sohalar', 'ja' => '学術分野'], 'value' => '18+'],
        ['label' => ['en' => 'Partner Networks', 'uz' => 'Hamkor tarmoqlar', 'ja' => 'パートナーネットワーク'], 'value' => '12'],
    ],

    'mission' => [
        'title' => ['en' => 'Our Mission', 'uz' => 'Bizning maqsadimiz', 'ja' => '私たちの使命'],
        'body' => [
            'en' => 'UAC Japan creates a trusted platform for Uzbek students, researchers, and alumni to exchange knowledge, build professional networks, and contribute to meaningful academic collaboration across Japan.',
            'uz' => 'UAC Japan özbek talabalari, tadqiqotçilari va bitiruvçilari uçun bilim almaşiş, professional aloqalar örnatiş va Yaponiya böylab mazmunli akademik hamkorlikka hissa qöşiş uçun işonçli platforma yaratadi.',
            'ja' => 'UAC Japanは、ウズベキスタン人学生・研究者・卒業生が知識を交換し、専門的なネットワークを築き、日本各地での意義ある学術協力に貢献できる信頼できるプラットフォームを構築します。',
        ],
    ],

    'vision' => [
        'title' => ['en' => 'Our Vision', 'uz' => 'Bizning kelajak qaraşimiz', 'ja' => '私たちのビジョン'],
        'body' => [
            'en' => 'We aim to become the most connected and credible Uzbek scholarly network in Japan, linking emerging talent with senior researchers, universities, and innovation partners.',
            'uz' => 'Bizning maqsadimiz — Yaponiyadagi eng boğlangan va işonçli özbek ilmiy tarmoğiga aylaniş, istedodli yoşlarni tajribali tadqiqotçilar, universitetlar va innovatsion hamkorlar bilan boğlaş.',
            'ja' => '私たちは、日本で最もつながりが深く信頼されるウズベキスタン人学術ネットワークとなり、新進の人材を上級研究者・大学・イノベーションパートナーと結びつけることを目指します。',
        ],
    ],

    // Seed source for `php artisan static:seed`; manage news in the admin panel afterwards.
    'latest_news' => [
        [
            'slug' => '2026-04-11-meeting-at-the-embassy',
            'title' => [
                'en' => 'Meeting at the Embassy of Uzbekistan in Japan',
                'uz' => 'Yaponiyadagi Özbekiston elçixonasida uçraşuv',
                'ja' => '在日ウズベキスタン大使館での例会',
            ],
            'date' => ['en' => 'April 11, 2026', 'uz' => '2026-yil 11-aprel', 'ja' => '2026年4月11日'],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2026-04-11-embassy-group.webp',
            'images' => [],
            'summary' => [
                'en' => 'More than 50 compatriots gathered at the Embassy of Uzbekistan in Japan for an interactive discussion, book talks by our writers, and the launch of the Uzbek translation of “Gakumon no Susume”.',
                'uz' => 'Yaponiyadagi Özbekiston elçixonasida 50 dan ortiq vatandoşimiz jam böldi: interaktiv muhokama, yozuvçilarimiz bilan kitob suhbati va “Gakumon no Susume” tarjimasining taqdimoti bölib ötdi.',
                'ja' => '在日ウズベキスタン大使館に50名を超える同胞が集まり、双方向のディスカッション、作家による著書の紹介、『学問のすゝめ』ウズベク語訳の発表が行われました。',
            ],
            'body' => [
                'en' => "Another rewarding meeting organised by the Uzbek Academic Club in Kanto was held today. It took place at the Embassy of Uzbekistan in Japan, and more than 50 of our compatriots came together.\n\nThe academic environment in Japan is orderly, rigorous, and inspiring. What is most heartening is that the number of young people in that environment who are hungry for knowledge and eager to do research keeps growing.\n\nIn the first part, the presentation took the form of an interactive discussion. Everyone present shared their own view, and the conversation was lively.\n\nIn the second part, our writers spoke about their books — what prompted them to write and what the central ideas are.\n\nThe third part was devoted to the launch of the Uzbek translation of “Gakumon no Susume” (An Encouragement of Learning). It was genuinely motivating.\n\nGatherings like this make you think again: the path of scholarship may be hard, but those who walk it are the strongest of all.\n\nApril 11, 2026 · Embassy of the Republic of Uzbekistan in Japan",
                'uz' => "Bugun Kanto hududida “Uzbek Academic Club” tomonidan taşkil etilgan yana bir mazmunli tadbir bölib ötdi. Tadbir Yaponiyadagi Özbekiston elçixonasida ötkazildi va 50 dan ortiq vatandoşimiz jam böldi.\n\nYaponiyadagi ilmiy muhit tartibli, çuqur va ilhomlantiruvçi. Eng quvonarlisi esa, şu muhitda ilmga çanqoq, izlanayotgan yoşlarimiz tobora köpayib borayotgani.\n\nBirinçi qismda taqdimot interaktiv diskussiya şaklida ötdi. Har bir iştirokçi öz fikrini bildirib, jonli muhokama böldi.\n\nIkkinçi qismda yozuvçilarimiz kitoblari haqida, uni yoziş uçun nima turtki bölgani va asosiy ğoyalari bilan bölişdi.\n\nUçinçi qism esa “Gakumon no Susume” (“Ilmga çaqiriq”) kitobi tarjimasining taqdimotiga bağişlandi — haqiqiy motivatsiya berdi.\n\nŞunaqa uçraşuvlar insonni yana öylaşga majbur qiladi: ilm yöli oğir bölsa ham, şu yölda yurayotganlar — eng kuçlilar.\n\n2026-yil 11-aprel · Özbekiston Respublikasining Yaponiyadagi elçixonasi",
                'ja' => "本日、Uzbek Academic Club in Kantoが主催する、実り多い例会が開催されました。会場は在日ウズベキスタン大使館で、50名を超える同胞が一堂に会しました。\n\n日本の学術環境は整然として奥深く、人を鼓舞するものがあります。なにより喜ばしいのは、そうした環境のなかで学問に飢え、研究に打ち込む若者が着実に増えていることです。\n\n第1部では、発表が双方向のディスカッション形式で行われました。参加者一人ひとりが自らの考えを述べ、活発な議論となりました。\n\n第2部では、作家の方々が自著について、執筆のきっかけと中心となる考えを語ってくださいました。\n\n第3部は、『学問のすゝめ』ウズベク語訳の発表に充てられました。まさに励みとなる内容でした。\n\nこうした集まりは、あらためて考えさせてくれます。学問の道は険しくとも、その道を歩む人々こそが最も強いのだと。\n\n2026年4月11日・在日ウズベキスタン共和国大使館",
            ],
        ],
        [
            'slug' => '2025-04-12-sixth-meeting-at-tsukuba',
            'title' => [
                'en' => 'Sixth Meeting at the University of Tsukuba',
                'uz' => 'Tsukuba universitetida 6-uçraşuv',
                'ja' => '筑波大学での第6回例会',
            ],
            'date' => ['en' => 'April 12, 2025', 'uz' => '2025-yil 12-aprel', 'ja' => '2025年4月12日'],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2025-04-12-tsukuba-group.webp',
            'images' => [],
            'summary' => [
                'en' => 'The University of Tsukuba hosted the club’s sixth meeting, bringing together more than 30 compatriots for talks on exchange-rate misalignment and on resilience in Central Eurasia.',
                'uz' => 'Klubning 6-uçraşuviga Tsukuba universiteti mezbonlik qildi: 30 dan ortiq yurtdoşimiz yiğildi, valyuta kursidagi nomuvofiqliklar va Markaziy Yevrosiyodagi barqarorlik böyiça taqdimotlar tinglandi.',
                'ja' => '筑波大学がクラブ第6回例会を主催し、30名を超える同胞が集まりました。為替レートの乖離と中央ユーラシアの安定性に関する発表が行われました。',
            ],
            'body' => [
                'en' => "Uzbek Academic Club in Kanto has been running for nearly two years now, and this was the sixth meeting held in that time. The University of Tsukuba hosted it.\n\nBecause we announced the meeting late, I had expected a smaller turnout. Not so: more than 30 compatriots came today, and it was especially good to see newly arrived students among them. Representatives and students came from Tsukuba, Waseda, Keio, Nagoya, and Tokyo University of Foreign Studies, along with compatriots who are already working, students from Japanese language schools, and even a brother from Tajikistan.\n\nThe meeting began at 11 o’clock. Alisher Umirdinov, the founder of the club, came despite being unwell and opened the gathering.\n\nMurodjon then spoke about his research on how misalignments in the real exchange rate affect economic growth — a genuinely fascinating study.\n\nAfter him, Botirjon presented his research plan on the factors that shape strong and weak resilience in the countries of Central Eurasia. The theoretical grounding is solid, and it is fair to say that a fine scholar is coming of age for our country.\n\nAfter the presentations we exchanged thoughts and talked at length over tea, getting to know everyone.\n\nIt was a joy to see future scholars and young people with a real appetite for research.\n\nOur warm thanks to the students of the University of Tsukuba, who organised the meeting impeccably — and especially to Umidjon, who brought them all together.\n\nApril 12, 2025 · University of Tsukuba",
                'uz' => "Uzbek Academic Club in Kanto taşkil etilganiga deyarli ikki yil böldi. Şu davr içida uçraşuv 6-marta ötkazildi. Bu galgi tadbirga Tsukuba universiteti mezbonlik qildi.\n\nEʼlonni keçroq berganimiz uçun talabalar kamroq yiğiladi deb öylagandim. Yöq, bugun 30 dan ortiq yurtdoşimiz keldi. Ular orasida yangi kelgan talabalarni köriş ayniqsa quvonarli. Tsukuba, Waseda, Keio, Nagoya va Tokio xorijiy tillar universitetidan vakillar va talabalar qatnaşdi. Bundan taşqari işlab yurgan yurtdoşlarimiz, yapon tili maktabi öquvçilari, hatto bir tojikistonlik qardoşimiz ham keldi.\n\nTadbir soat 11 da boşlandi. Kasal bölişiga qaramay kelgan klub asosçisi Alişer aka Umirdinov uçraşuvni oçib berdi.\n\nSöngra Murodjon aka valyutaning real almaşuv kursidagi nomuvofiqliklar iqtisodiy ösişga qanday taʼsir qilişi haqidagi tadqiqoti bilan taniştirdi. Juda qiziqarli tadqiqot ekan.\n\nUndan keyin Botirjon Markaziy Yevrosiyo mamlakatlarida kuçli va zaif barqarorlikni şakllantiruvçi omillar haqidagi tadqiqot rejasini namoyiş qildi. Nazariy asosi puxta — yurtimiz uçun ajoyib bir olim yetişib kelayotganini bemalol aytiş mumkin.\n\nTaqdimotlardan söng özaro fikr almaşib, çoy ustida miriqib suhbatlaşdik, hamma bilan tanişdik.\n\nBölajak olimlarni, ilmga intiluvçan yoşlarni körib xursand böldik.\n\nTadbirni mukammal taşkil etgan Tsukuba universiteti talabalariga katta rahmat! Xususan, ularni birlaştirgan Umidjonga alohida tahsin.\n\n2025-yil 12-aprel · Tsukuba universiteti",
                'ja' => "Uzbek Academic Club in Kantoの設立からまもなく2年が経ち、今回がその間に開かれた6回目の例会となりました。会場は筑波大学です。\n\n告知が遅れたため参加者は少ないだろうと思っていましたが、今日は30名を超える同胞が集まりました。なかでも来日したばかりの学生の姿が見られたことは大きな喜びです。筑波大学、早稲田大学、慶應義塾大学、名古屋、東京外国語大学から教職員や学生が参加したほか、すでに就業している同胞、日本語学校の学生、さらにはタジキスタンから来た仲間も加わりました。\n\n例会は11時に始まりました。体調が優れないなか駆けつけたクラブ創設者のAlisher Umirdinov氏が開会の挨拶を述べました。\n\n続いてMurodjon氏が、実質為替レートの乖離が経済成長に与える影響についての研究を紹介しました。実に興味深い研究です。\n\nその後、Botirjon氏が中央ユーラシア諸国における強い安定性と弱い安定性を形づくる要因についての研究計画を発表しました。理論的な土台は堅固で、わが国にとって優れた研究者が育ちつつあると言ってよいでしょう。\n\n発表のあとは意見を交わし、お茶を囲んでじっくりと語り合い、参加者同士で親睦を深めました。\n\n未来の研究者たち、学問への意欲にあふれる若者たちの姿を見ることができ、うれしく思います。\n\n見事に運営してくださった筑波大学の学生の皆さま、そして皆をまとめてくださったUmidjon氏に、心より感謝申し上げます。\n\n2025年4月12日・筑波大学",
            ],
        ],
        [
            'slug' => '2025-01-25-first-meeting-of-the-year-at-yokohama',
            'title' => [
                'en' => 'Yokohama: First Meeting of the Year',
                'uz' => 'Yokohamada yil hisobidagi birinçi uçraşuv',
                'ja' => '横浜：今年最初の例会',
            ],
            'date' => ['en' => 'January 25, 2025', 'uz' => '2025-yil 25-yanvar', 'ja' => '2025年1月25日'],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2025-01-ynu-kanto-group.webp',
            'images' => [],
            'summary' => [
                'en' => 'More than 20 compatriots gathered at Yokohama National University for the first meeting of the year, with talks on circular economy research, a new career portal, and visa matters.',
                'uz' => 'Yokohama milliy universitetida yil hisobidagi birinçi uçraşuv bölib ötdi: 20 dan ortiq yurtdoşimiz yiğildi, sirkulyar iqtisodiyot, Career portal loyihasi va viza masalalari böyiça taqdimotlar tinglandi.',
                'ja' => '横浜国立大学にて今年最初の例会が開かれ、20名を超える同胞が集まりました。循環型経済の研究、新しいキャリアポータル、ビザに関する発表が行われました。',
            ],
            'body' => [
                'en' => "The first meeting of the year of the Uzbek Academic Club was held at Yokohama National University. More than 20 of our compatriots took part: students came from Tsukuba, Waseda, Hitotsubashi, Toyo, Aichi, Tokyo University of Foreign Studies, and the host university.\n\nThree participants gave presentations. Elbek Ibrohimov, representing the host university, spoke first: after eight years of professional experience, he has taken up research on the circular economy, and he assured us that very promising work lies ahead.\n\nJurabek Khasanov then presented a newly launched project, a career portal. Do take a look at it yourself: https://japancareer.uz/uz — you will find answers to many questions about Japan there. A genuinely useful platform for our community is taking shape.\n\nTo close the meeting, Alisher Umirdinov shared practical information on visa matters. Many of us had not realised how straightforward it is to obtain a European visa from Japan. His experience and his eagerness to share knowledge are a constant inspiration.\n\nWith bright-eyed young men and women — and even a one-year-old girl — in the room, it was a warm and welcoming gathering. A setting like this is something special; it would be no surprise if the foundation for several future professors was laid here.\n\nOur thanks go to our friends in Yokohama for their excellent preparation.\n\nThe next meeting will be held on Saturday, April 12, at the University of Tsukuba. Do come along this time — you will not regret the time spent. See you at the next meeting!\n\nJanuary 25, 2025 · Yokohama National University (YNU)",
                'uz' => "Uzbek Academic Clubning yil hisobidagi birinçi uçraşuvi Yokohama milliy universitetida bölib ötdi. Ilm majlisida 20 dan ortiq yurtdoşimiz iştirok etdi: Tsukuba, Waseda, Hitotsubaşi, Toyo, Aiçi, Tokio xorijiy tillar universiteti va mezbon universitetdan yigit-qizlar keldi.\n\nTadbirda uç nafar iştirokçi taqdimot qildi. Dastlab mezbon universitet vakili Elbek Ibrohimov söz oldi: u sakkiz yillik iş tajribasidan söng sirkulyar iqtisodiyot böyiça tadqiqotga qöl urgan ekan va juda istiqbolli iş kutilayotganini bildirdi.\n\nSöngra Jurabek Xasanov yangi boşlangan loyiha — Career portal taqdimotini qildi. Siz ham ushbu portalga kirib köring: https://japancareer.uz/uz — Yaponiya haqidagi köp savolga javob topasiz. Yurtdoşlarimiz uçun juda yaxşi platforma şakllanmoqda.\n\nTadbir yakunida ustoz Alişer Umirdinov viza masalalari böyiça maʼlumot berdi. Yaponiyadan Yevropaga viza oliş bu qadar oson ekanini köpçilik bilmas ekan. Bu insonning tajribasi va ilm ulaşişga bölgan intilişi doimo qoyil qoldiradi.\n\nKözi çaqnab turgan yigit-qizlar, hatto bir yoşli qizaloq bilan birga juda fayzli uçraşuv bölib ötdi. Bunday tadbir, bunday muhit baribir boşqaça — kelajakda şu yerda bir neça professor uçun tamal toşi qöyilgan bölsa ajab emas.\n\nYokohamadagi akalarga va ularning tayyorgarligiga katta rahmat.\n\nKeyingi tadbir 12-aprel, şanba kuni Tsukuba universitetida bölib ötadi. Bu safar albatta keling — vaqtingizga açinmaysiz. Keyingi uçraşuvda körişamiz!\n\n2025-yil 25-yanvar · Yokohama milliy universiteti (YNU)",
                'ja' => "Uzbek Academic Clubの今年最初の例会が、横浜国立大学で開催されました。20名を超える同胞が参加し、筑波大学、早稲田大学、一橋大学、東洋大学、愛知の大学、東京外国語大学、そして会場校から学生が集まりました。\n\n当日は3名が発表を行いました。はじめに、会場校を代表してElbek Ibrohimov氏が登壇。8年間の実務経験を経て循環型経済の研究に取り組んでおり、今後の展開に大きな期待が寄せられていることを語りました。\n\n続いてJurabek Khasanov氏が、立ち上げたばかりのキャリアポータルについて発表しました。ぜひ一度ご覧ください：https://japancareer.uz/uz — 日本に関する多くの疑問への答えが見つかります。同胞のための実に有用なプラットフォームが形になりつつあります。\n\n最後に、Alisher Umirdinov氏がビザに関する実践的な情報を共有しました。日本からヨーロッパのビザを取得するのがこれほど容易だとは、多くの人が知りませんでした。氏の経験と、知識を惜しみなく分かち合う姿勢にはいつも感銘を受けます。\n\n目を輝かせた若者たち、そして1歳の女の子も加わり、とても和やかな集まりとなりました。こうした場はやはり特別で、将来の教授たちの礎がここで築かれたとしても不思議ではありません。\n\n入念に準備してくださった横浜の皆さまに、心より感謝申し上げます。\n\n次回の例会は4月12日（土）、筑波大学で開催されます。今回こそぜひご参加ください。きっと時間を惜しいとは思わないはずです。次回の例会でお会いしましょう！\n\n2025年1月25日・横浜国立大学（YNU）",
            ],
        ],
        [
            'slug' => '2024-11-30-final-meeting-of-the-year-in-kanto',
            'title' => [
                'en' => 'Kanto: Final Meeting of the Year',
                'uz' => 'Kantoda yil hisobidagi oxirgi uçraşuv',
                'ja' => '関東：今年度最後の例会',
            ],
            'date' => ['en' => 'November 30, 2024', 'uz' => '2024-yil 30-noyabr', 'ja' => '2024年11月30日'],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2024-11-30-tufs-kanto-group.webp',
            'images' => [],
            'summary' => [
                'en' => 'Around 40 compatriots gathered at TUFS for the fourth and final Kanto meeting of the year, featuring a road-safety research talk and an open Q&A session.',
                'uz' => 'TUFSda yil hisobidagi törtinçi va oxirgi Kanto uçraşuvi bölib ötdi: 40 ga yaqin yurtdoşimiz yiğildi, yöl xavfsizligi böyiça tadqiqot taqdimoti va oçiq savol-javob sessiyasi ötkazildi.',
                'ja' => '東京外国語大学（TUFS）にて、今年度4回目となる関東支部最後の例会が開かれ、約40名の同胞が集まりました。交通安全に関する研究発表と自由な質疑応答が行われました。',
            ],
            'body' => [
                'en' => "On Saturday, November 30, the fourth meeting of the year was held at Tokyo University of Foreign Studies. Around 40 of our compatriots attended.\n\nBekzod Turatov, a master’s student at Yokohama National University, gave an excellent talk on road safety in Tashkent. The data he has collected and the way he works with it deserve particular attention. On that basis, research is taking shape that can meaningfully reduce the number of traffic accidents.\n\nIn the second part of the meeting, Alisher Umirdinov spoke with the participants and answered their questions. The drive and enthusiasm for scholarship among these young men and women is remarkable.\n\nIn a word, the meeting was both enjoyable and genuinely useful. The spark in the eyes of the students who came will bear fruit in the years ahead.\n\nThe next meeting will be held at Yokohama National University at the end of January 2025 — we have passed the baton to another university. Elbek and Bekzod will host it wonderfully.\n\nWe look forward to seeing you at our next academic gatherings!\n\nOur special thanks go to the students of Tokyo University of Foreign Studies for hosting this meeting.\n\nNovember 30, 2024 · Tokyo University of Foreign Studies (TUFS)",
                'uz' => "30-noyabr, şanba kuni Tokio xorijiy tillar universitetida yil hisobidan 4-tadbir bölib ötdi. Tadbirga 40 ga yaqin yurtdoşimiz keldi.\n\nYokohama universiteti magistranti Bekzod Turatov Toşkentdagi yöl xavfsizligi mavzusida ajoyib çiqiş qildi. Uning töplagan maʼlumotlari va ular bilan işlaş uslubi alohida eʼtiborga loyiq. Şu asosda yöl-transport hodisalarini sezilarli darajada kamaytirişga xizmat qiladigan tadqiqot işi yetilib bormoqda.\n\nTadbirning ikkinçi qismida Alişer Umirdinov kelgan yurtdoşlar bilan suhbatlaşib, savollarga javob berdi. Yigit-qizlardagi ilmga bölgan şijoat va ğayrat juda kuçli.\n\nTadbir bir söz bilan aytganda, juda foydali bölib ötdi. Kelgan talabalar közidagi nur kelajakda öz samarasini beradi.\n\nKeyingi tadbir 2025-yil yanvar oyi oxirida Yokohama universitetida bölib ötadi — estafetani yana bir universitetga topşirdik. Elbek va Bekzod akalar mezbonlikni ajoyib tarzda ötkazişadi.\n\nSizni ham keyingi ilmiy uçraşuvlarimizda kutamiz!\n\nBugungi tadbir uçun Tokio xorijiy tillar universiteti talabalariga alohida minnatdorçilik bildiramiz.\n\n2024-yil 30-noyabr · Tokio xorijiy tillar universiteti (TUFS)",
                'ja' => "11月30日（土）、東京外国語大学にて今年度4回目の例会が開催され、約40名の同胞が集まりました。\n\n横浜国立大学修士課程のBekzod Turatov氏が、タシケントの交通安全について素晴らしい発表を行いました。氏が集めたデータとその扱い方は特筆に値します。これを基に、交通事故の件数を大きく減らしうる研究が形になりつつあります。\n\n例会の後半では、Alisher Umirdinov氏が参加者と語り合い、質問に答えました。若い参加者たちの学問への意欲と熱意には目を見張るものがあります。\n\n一言で言えば、とても有意義な会となりました。集まった学生たちの眼差しに宿る輝きは、これからの年月で必ず実を結ぶことでしょう。\n\n次回の例会は2025年1月下旬、横浜国立大学で開催されます。バトンはまた別の大学へ渡りました。ElbekさんとBekzodさんが素晴らしい形で主催してくださることでしょう。\n\n次回の学術交流の場でも、皆さまのお越しをお待ちしています！\n\n今回の例会の開催にあたり、東京外国語大学の学生の皆さまに心より感謝申し上げます。\n\n2024年11月30日・東京外国語大学（TUFS）",
            ],
        ],
        [
            'slug' => '2024-05-27-first-meeting-of-the-year',
            'title' => [
                'en' => 'First Meeting of the Year',
                'uz' => 'Bu yil hisobidan birinçi uçraşuv',
                'ja' => '今年最初の例会',
            ],
            'date' => ['en' => 'May 27, 2024', 'uz' => '2024-yil 27-may', 'ja' => '2024年5月27日'],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/news/2024-05-27-tufs-meeting.webp',
            'images' => [],
            'summary' => [
                'en' => 'The Academic Club of young Uzbek researchers in Tokyo met at TUFS and welcomed new talent from across the Kanto region.',
                'uz' => 'Tokiodagi özbekistonlik yoş tadqiqotçilarning Akademik klubi TUFSda yiğilib, Kanto mintaqasidan kelgan yangi iqtidorlar bilan tanişdi.',
                'ja' => '東京の若手ウズベキスタン人研究者によるアカデミッククラブが東京外国語大学で例会を開き、関東各地から集まった新しいメンバーを迎えました。',
            ],
            'body' => [
                'en' => "The Academic Club of young Uzbek researchers in Tokyo held its meeting, where we got to know the new talent who gathered from across the Kanto region, home to Tokyo.\n\nAt the event, Alisher Umirdinov presented the new book he is preparing for publication, and Firdavs Khasanov, a doctoral student at the University of Tsukuba, shared his research findings on mentorship in Japan.\n\nThe next meeting will be held in July at the University of Tsukuba in Ibaraki Prefecture. We look forward to seeing you there!\n\nMay 27, 2024 · Tokyo University of Foreign Studies (TUFS)",
                'uz' => "Tokiodagi özbekistonlik yoş tadqiqotçilarning Akademik klubi yiğilişi bölib ötdi. Tokio joylaşgan Kanto mintaqasidan yiğilgan yangi iqtidorlar bilan yaqindan tanişildi.\n\nTadbirda Alişer aka Umirdinov naşrga tayyorlayotgan yangi kitobi taqdimotini qildilar, Tsukuba universiteti doktoranti Firdavs aka Xasanov esa Yaponiyadagi mentorlikka oid ilmiy natijalari bilan bölişdilar.\n\nKeyingi yiğiliş iyul oyida Ibaraki prefekturasidagi Tsukuba universitetida bölib ötadi. Sizni ham albatta kutamiz!\n\n2024-yil 27-may · Tokio xorijiy tillar universiteti (TUFS)",
                'ja' => "東京の若手ウズベキスタン人研究者によるアカデミッククラブの例会が開催され、東京を含む関東各地から集まった新しいメンバーと親交を深めました。\n\n当日は、Alisher Umirdinov氏が出版準備中の新著を紹介し、筑波大学博士課程のFirdavs Khasanov氏が日本におけるメンタリングに関する研究成果を共有しました。\n\n次回の例会は7月に茨城県の筑波大学で開催予定です。皆さまのご参加をお待ちしています！\n\n2024年5月27日・東京外国語大学（TUFS）",
            ],
        ],
    ],

    'regions' => [
        'kanto' => [
            'slug' => 'kanto',
            'name' => ['en' => 'UAC Kanto', 'uz' => 'UAC Kanto', 'ja' => 'UAC関東'],
            'short_name' => ['en' => 'Kanto', 'uz' => 'Kanto', 'ja' => '関東'],
            'status' => ['en' => 'Active Chapter', 'uz' => 'Faol bölim', 'ja' => '活動中の支部'],
            'members_count' => ['en' => '200+ members', 'uz' => '200+ aʼzo', 'ja' => '200名以上のメンバー'],
            'locations' => ['en' => 'Tokyo, Yokohama, Chiba, Saitama', 'uz' => 'Tokio, Yokohama, Çiba, Saitama', 'ja' => '東京、横浜、千葉、埼玉'],
            'summary' => [
                'en' => 'The central hub for UAC activities, connecting scholars across Japan’s largest academic and research ecosystem.',
                'uz' => 'UAC faoliyatining markaziy markazi bölib, Yaponiyaning eng yirik ilmiy-tadqiqot ekotizimidagi olimlarni boğlaydi.',
                'ja' => 'UAC活動の中心拠点であり、日本最大の学術・研究エコシステム全体の研究者をつなぎます。',
            ],
            'excerpt' => [
                'en' => 'A strong chapter serving major universities and research institutions in the Greater Tokyo area.',
                'uz' => 'Katta Tokio hududidagi yirik universitetlar va tadqiqot institutlariga xizmat qiluvçi kuçli bölim.',
                'ja' => '首都圏の主要大学・研究機関を支える強力な支部です。',
            ],
            'image' => 'images/regions/kanto-card.webp',
            'hero_image' => 'images/regions/kanto-hero.webp',
            'about' => [
                'en' => 'The Kanto chapter connects leading Uzbek scholars, researchers, and students across Tokyo and surrounding prefectures. It supports mentorship, institutional networking, and visibility for academic achievements across disciplines.',
                'uz' => 'Kanto bölimi Tokio va atrofidagi prefekturalardagi yetakçi özbek olimlari, tadqiqotçilari va talabalarini boğlaydi. U murabbiylik, institutsional aloqalar va turli sohalardagi ilmiy yutuqlarning körinişini qöllab-quvvatlaydi.',
                'ja' => '関東支部は、東京および周辺県で活躍する優れたウズベキスタン人の学者・研究者・学生をつなぎます。メンタリング、機関間ネットワーキング、分野を超えた学術的成果の可視化を支援しています。',
            ],
            'universities' => [
                ['en' => 'The University of Tokyo', 'uz' => 'Tokio universiteti', 'ja' => '東京大学'],
                ['en' => 'Waseda University', 'uz' => 'Vaseda universiteti', 'ja' => '早稲田大学'],
                ['en' => 'Keio University', 'uz' => 'Keyo universiteti', 'ja' => '慶應義塾大学'],
                ['en' => 'Tokyo Institute of Technology', 'uz' => 'Tokio texnologiya instituti', 'ja' => '東京工業大学'],
            ],
            'activities' => [
                [
                    'title' => ['en' => 'Graduate Research Roundtable', 'uz' => 'Magistrantlar tadqiqot davra suhbati', 'ja' => '大学院生リサーチ・ラウンドテーブル'],
                    'date' => ['en' => 'Monthly', 'uz' => 'Har oy', 'ja' => '毎月'],
                    'description' => [
                        'en' => 'Peer feedback sessions for master’s and doctoral research proposals.',
                        'uz' => 'Magistratura va doktorantura tadqiqot takliflari uçun özaro fikr-mulohaza sessiyalari.',
                        'ja' => '修士・博士課程の研究提案に対するピアフィードバックセッション。',
                    ],
                ],
                [
                    'title' => ['en' => 'Industry Meets Academia Night', 'uz' => 'Sanoat va akademiya keçasi', 'ja' => '産学交流ナイト'],
                    'date' => ['en' => 'Quarterly', 'uz' => 'Har çorakda', 'ja' => '四半期ごと'],
                    'description' => [
                        'en' => 'Career networking with researchers, startup founders, and institutional partners.',
                        'uz' => 'Tadqiqotçilar, startap asosçilari va institutsional hamkorlar bilan karyera böyiça tarmoqlaşiş.',
                        'ja' => '研究者、スタートアップ創業者、機関パートナーとのキャリアネットワーキング。',
                    ],
                ],
            ],
            'secretaries' => [
                ['name' => 'Dr. Alisher Vokhidov', 'role' => ['en' => 'Regional Secretary', 'uz' => 'Regional kotib', 'ja' => '地域幹事'], 'affiliation' => ['en' => 'Research Fellow, UTokyo', 'uz' => 'Ilmiy xodim, Tokio universiteti', 'ja' => '東京大学 研究員']],
                ['name' => 'Malika Rustamova', 'role' => ['en' => 'Events Coordinator', 'uz' => 'Tadbirlar muvofiqlaştiruvçisi', 'ja' => 'イベントコーディネーター'], 'affiliation' => ['en' => 'Ph.D. Candidate, Waseda University', 'uz' => 'PhD doktorant, Vaseda universiteti', 'ja' => '早稲田大学 博士課程'],],
            ],
            'contact' => [
                'email' => 'kanto@uacjp.uz',
                'phone' => '+81 (0)3-5555-0101',
                'city' => ['en' => 'Tokyo', 'uz' => 'Tokio', 'ja' => '東京'],
            ],
            'gallery' => [
                ['title' => ['en' => 'Research networking reception', 'uz' => 'Tadqiqot tarmoqlaşiş qabul marosimi', 'ja' => 'リサーチ・ネットワーキング・レセプション'], 'tone' => 'from-primary/90 to-primary/35'],
                ['title' => ['en' => 'Student advisory circle', 'uz' => 'Talabalar maslahat doirasi', 'ja' => '学生アドバイザリーサークル'], 'tone' => 'from-secondary/90 to-secondary/35'],
                ['title' => ['en' => 'University visit briefing', 'uz' => 'Universitetga taşrif böyiça brifing', 'ja' => '大学訪問ブリーフィング'], 'tone' => 'from-accent/90 to-accent/35'],
            ],
            'plans' => [
                ['en' => 'Expand regional mentoring pairs for newly arrived graduate students.', 'uz' => 'Yangi kelgan magistrantlar uçun mintaqaviy murabbiylik juftliklarini kengaytiriş.', 'ja' => '新しく来日した大学院生向けの地域メンタリングペアを拡大する。'],
                ['en' => 'Launch a bilingual scholar profile series highlighting ongoing research.', 'uz' => 'Davom etayotgan tadqiqotlarni yorituvçi ikki tilli olim profillari seriyasini işga tuşiriş.', 'ja' => '進行中の研究を紹介するバイリンガルの研究者プロフィールシリーズを開始する。'],
                ['en' => 'Coordinate a flagship symposium with partner laboratories in Tokyo.', 'uz' => 'Tokiodagi hamkor laboratoriyalar bilan yetakçi simpoziumni muvofiqlaştiriş.', 'ja' => '東京のパートナー研究室と主要シンポジウムを共催する。'],
            ],
        ],
        'kansai' => [
            'slug' => 'kansai',
            'name' => ['en' => 'UAC Kansai', 'uz' => 'UAC Kansai', 'ja' => 'UAC関西'],
            'short_name' => ['en' => 'Kansai', 'uz' => 'Kansai', 'ja' => '関西'],
            'status' => ['en' => 'Active Chapter', 'uz' => 'Faol bölim', 'ja' => '活動中の支部'],
            'members_count' => ['en' => '150+ members', 'uz' => '150+ aʼzo', 'ja' => '150名以上のメンバー'],
            'locations' => ['en' => 'Osaka, Kyoto, Kobe, Nara', 'uz' => 'Osaka, Kioto, Kobe, Nara', 'ja' => '大阪、京都、神戸、奈良'],
            'summary' => [
                'en' => 'A chapter connecting historic academic cities with high-impact modern research communities.',
                'uz' => 'Tarixiy ilmiy şaharlarni yuqori taʼsirli zamonaviy tadqiqot hamjamiyatlari bilan boğlovçi bölim.',
                'ja' => '歴史ある学術都市と影響力の大きい現代の研究コミュニティをつなぐ支部です。',
            ],
            'excerpt' => [
                'en' => 'Bridging academic tradition and emerging research communities in western Japan.',
                'uz' => 'Ğarbiy Yaponiyada ilmiy anʼana va yangi paydo bölayotgan tadqiqot hamjamiyatlari örtasida köprik.',
                'ja' => '西日本の学術的伝統と新興の研究コミュニティをつなぐ架け橋。',
            ],
            'image' => 'images/regions/kansai-card.webp',
            'hero_image' => 'images/regions/kansai-hero.webp',
            'about' => [
                'en' => 'The Kansai chapter supports scholars in Kyoto, Osaka, Kobe, and nearby academic centers. Its programs emphasize interdisciplinary exchange, visiting scholar welcome sessions, and academic community building.',
                'uz' => 'Kansai bölimi Kioto, Osaka, Kobe va yaqin atrofdagi ilmiy markazlardagi olimlarni qöllab-quvvatlaydi. Uning dasturlari fanlararo almaşinuv, mehmon olimlarni kutib oliş tadbirlari va ilmiy hamjamiyatni şakllantirişga urğu beradi.',
                'ja' => '関西支部は、京都、大阪、神戸およびその周辺の学術拠点の研究者を支援します。学際的交流、客員研究者歓迎セッション、学術コミュニティの構築に重点を置いています。',
            ],
            'universities' => [
                ['en' => 'Kyoto University', 'uz' => 'Kioto universiteti', 'ja' => '京都大学'],
                ['en' => 'Osaka University', 'uz' => 'Osaka universiteti', 'ja' => '大阪大学'],
                ['en' => 'Kobe University', 'uz' => 'Kobe universiteti', 'ja' => '神戸大学'],
                ['en' => 'Ritsumeikan University', 'uz' => 'Ritsumeykan universiteti', 'ja' => '立命館大学'],
            ],
            'activities' => [
                [
                    'title' => ['en' => 'Interdisciplinary Colloquium', 'uz' => 'Fanlararo kollokvium', 'ja' => '学際コロキウム'],
                    'date' => ['en' => 'Bi-monthly', 'uz' => 'Ikki oyda bir marta', 'ja' => '隔月'],
                    'description' => [
                        'en' => 'A discussion forum for social sciences, humanities, and engineering researchers.',
                        'uz' => 'Ijtimoiy fanlar, gumanitar fanlar va muhandislik tadqiqotçilari uçun muhokama forumi.',
                        'ja' => '社会科学、人文学、工学分野の研究者のためのディスカッションフォーラム。',
                    ],
                ],
                [
                    'title' => ['en' => 'Cultural Diplomacy Gatherings', 'uz' => 'Madaniy diplomatiya uçraşuvlari', 'ja' => '文化外交交流会'],
                    'date' => ['en' => 'Seasonal', 'uz' => 'Mavsumiy', 'ja' => '季節ごと'],
                    'description' => [
                        'en' => 'Community events that combine academic networking with Uzbek cultural outreach.',
                        'uz' => 'Ilmiy tarmoqlaşişni özbek madaniy tarğiboti bilan uyğunlaştiruvçi hamjamiyat tadbirlari.',
                        'ja' => '学術ネットワーキングとウズベキスタン文化交流を組み合わせたコミュニティイベント。',
                    ],
                ],
            ],
            'secretaries' => [
                ['name' => 'Malika Rustamova', 'role' => ['en' => 'Regional Secretary', 'uz' => 'Regional kotib', 'ja' => '地域幹事'], 'affiliation' => ['en' => 'Doctoral Researcher, Kobe University', 'uz' => 'Doktorant-tadqiqotçi, Kobe universiteti', 'ja' => '神戸大学 博士課程研究員']],
                ['name' => 'Bekzod Kholmatov', 'role' => ['en' => 'Member Outreach Lead', 'uz' => 'Aʼzolar bilan işlaş rahbari', 'ja' => 'メンバーアウトリーチ責任者'], 'affiliation' => ['en' => 'Research Associate, Kyoto University', 'uz' => 'Ilmiy hamkor, Kioto universiteti', 'ja' => '京都大学 研究員']],
            ],
            'contact' => [
                'email' => 'kansai@uacjp.uz',
                'phone' => '+81 (0)6-5555-0102',
                'city' => ['en' => 'Kyoto', 'uz' => 'Kioto', 'ja' => '京都'],
            ],
            'gallery' => [
                ['title' => ['en' => 'Kyoto chapter seminar', 'uz' => 'Kioto bölimi seminari', 'ja' => '京都支部セミナー'], 'tone' => 'from-primary-container/90 to-primary/35'],
                ['title' => ['en' => 'Community roundtable', 'uz' => 'Hamjamiyat davra suhbati', 'ja' => 'コミュニティ・ラウンドテーブル'], 'tone' => 'from-secondary/95 to-primary/30'],
                ['title' => ['en' => 'Partner institution visit', 'uz' => 'Hamkor muassasaga taşrif', 'ja' => 'パートナー機関訪問'], 'tone' => 'from-accent/90 to-primary/45'],
            ],
            'plans' => [
                ['en' => 'Build a stronger alumni mentoring bridge for students entering Japanese universities.', 'uz' => 'Yaponiya universitetlariga kirayotgan talabalar uçun bitiruvçilar murabbiyligi köprigini mustahkamlaş.', 'ja' => '日本の大学に進学する学生のための卒業生メンタリングの橋渡しを強化する。'],
                ['en' => 'Increase collaboration with research institutes in Osaka and Kobe.', 'uz' => 'Osaka va Kobedagi tadqiqot institutlari bilan hamkorlikni kengaytiriş.', 'ja' => '大阪・神戸の研究機関との連携を強化する。'],
                ['en' => 'Publish a regional academic opportunities digest each semester.', 'uz' => 'Har semestrda mintaqaviy ilmiy imkoniyatlar töplamini naşr etiş.', 'ja' => '毎学期、地域の学術機会に関するダイジェストを発行する。'],
            ],
        ],
        'chubu' => [
            'slug' => 'chubu',
            'name' => ['en' => 'UAC Chubu', 'uz' => 'UAC Çubu', 'ja' => 'UAC中部'],
            'short_name' => ['en' => 'Chubu', 'uz' => 'Çubu', 'ja' => '中部'],
            'status' => ['en' => 'Active Chapter', 'uz' => 'Faol bölim', 'ja' => '活動中の支部'],
            'members_count' => ['en' => '90+ members', 'uz' => '90+ aʼzo', 'ja' => '90名以上のメンバー'],
            'locations' => ['en' => 'Nagoya, Shizuoka, Gifu', 'uz' => 'Nagoya, Şizuoka, Gifu', 'ja' => '名古屋、静岡、岐阜'],
            'summary' => [
                'en' => 'An emerging chapter linking engineering, manufacturing, and applied science communities in central Japan.',
                'uz' => 'Markaziy Yaponiyada muhandislik, işlab çiqariş va amaliy fan hamjamiyatlarini boğlovçi rivojlanayotgan bölim.',
                'ja' => '中部日本の工学・製造業・応用科学コミュニティをつなぐ新興支部です。',
            ],
            'excerpt' => [
                'en' => 'A growing chapter focused on applied sciences, engineering, and regional collaboration.',
                'uz' => 'Amaliy fanlar, muhandislik va mintaqaviy hamkorlikka eʼtibor qaratgan ösib borayotgan bölim.',
                'ja' => '応用科学・工学・地域連携に重点を置く成長中の支部。',
            ],
            'image' => 'images/regions/chubu-card.webp',
            'hero_image' => 'images/regions/chubu-hero.webp',
            'about' => [
                'en' => 'The Chubu chapter creates space for scholars working in engineering, materials science, design, and industrial innovation. It is strengthening ties among students, postdoctoral researchers, and partner universities in central Japan.',
                'uz' => 'Çubu bölimi muhandislik, materialşunoslik, dizayn va sanoat innovatsiyasi sohalarida işlaydigan olimlar uçun makon yaratadi. U markaziy Yaponiyadagi talabalar, postdoktorantlar va hamkor universitetlar örtasidagi aloqalarni mustahkamlamoqda.',
                'ja' => '中部支部は、工学・材料科学・デザイン・産業イノベーションに携わる研究者のための場を提供します。中部日本の学生、博士研究員、パートナー大学間のつながりを強化しています。',
            ],
            'universities' => [
                ['en' => 'Nagoya University', 'uz' => 'Nagoya universiteti', 'ja' => '名古屋大学'],
                ['en' => 'Shizuoka University', 'uz' => 'Şizuoka universiteti', 'ja' => '静岡大学'],
                ['en' => 'Gifu University', 'uz' => 'Gifu universiteti', 'ja' => '岐阜大学'],
                ['en' => 'Toyohashi University of Technology', 'uz' => 'Toyohaşi texnologiya universiteti', 'ja' => '豊橋技術科学大学'],
            ],
            'activities' => [
                [
                    'title' => ['en' => 'Applied Science Showcase', 'uz' => 'Amaliy fan körgazmasi', 'ja' => '応用科学ショーケース'],
                    'date' => ['en' => 'Twice a year', 'uz' => 'Yiliga ikki marta', 'ja' => '年2回'],
                    'description' => [
                        'en' => 'Presentations featuring practical research with industrial relevance.',
                        'uz' => 'Sanoat ahamiyatiga ega amaliy tadqiqotlar böyiça taqdimotlar.',
                        'ja' => '産業界に関連する実践的研究の発表会。',
                    ],
                ],
                [
                    'title' => ['en' => 'Peer Mentoring Clinic', 'uz' => 'Özaro murabbiylik klinikasi', 'ja' => 'ピア・メンタリング・クリニック'],
                    'date' => ['en' => 'Monthly', 'uz' => 'Har oy', 'ja' => '毎月'],
                    'description' => [
                        'en' => 'Small-group sessions on scholarship applications, publishing, and student life.',
                        'uz' => 'Stipendiya arizalari, naşr qiliş va talabalik hayoti böyiça kiçik guruh sessiyalari.',
                        'ja' => '奨学金応募、論文出版、学生生活に関する少人数セッション。',
                    ],
                ],
            ],
            'secretaries' => [
                ['name' => 'Nilufar Ergasheva', 'role' => ['en' => 'Regional Secretary', 'uz' => 'Regional kotib', 'ja' => '地域幹事'], 'affiliation' => ['en' => 'Ph.D. Researcher, Nagoya University', 'uz' => 'PhD tadqiqotçi, Nagoya universiteti', 'ja' => '名古屋大学 博士研究員']],
                ['name' => 'Sherzod Akhmedov', 'role' => ['en' => 'University Liaison', 'uz' => 'Universitet aloqalari böyiça vakil', 'ja' => '大学連携担当'], 'affiliation' => ['en' => 'Graduate Student, Toyohashi Tech', 'uz' => 'Magistrant, Toyohaşi texnologiya universiteti', 'ja' => '豊橋技術科学大学 大学院生']],
            ],
            'contact' => [
                'email' => 'chubu@uacjp.uz',
                'phone' => '+81 (0)52-5555-0103',
                'city' => ['en' => 'Nagoya', 'uz' => 'Nagoya', 'ja' => '名古屋'],
            ],
            'gallery' => [
                ['title' => ['en' => 'Innovation workshop', 'uz' => 'Innovatsiya seminari', 'ja' => 'イノベーション・ワークショップ'], 'tone' => 'from-primary/80 to-secondary/30'],
                ['title' => ['en' => 'Lab-to-lab exchange', 'uz' => 'Laboratoriyalararo almaşinuv', 'ja' => 'ラボ間交流'], 'tone' => 'from-secondary/85 to-accent/35'],
                ['title' => ['en' => 'Mentorship breakfast', 'uz' => 'Murabbiylik nonuştasi', 'ja' => 'メンターシップ・ブレックファスト'], 'tone' => 'from-accent/85 to-primary/25'],
            ],
            'plans' => [
                ['en' => 'Formalize industry-academic partnership sessions for Chubu-based members.', 'uz' => 'Çubu aʼzolari uçun sanoat-akademiya hamkorlik sessiyalarini rasmiylaştiriş.', 'ja' => '中部エリアのメンバー向けに産学連携セッションを制度化する。'],
                ['en' => 'Create a regional speaker roster for university outreach events.', 'uz' => 'Universitet tarğibot tadbirlari uçun mintaqaviy maʼruzaçilar röyxatini yaratiş.', 'ja' => '大学アウトリーチイベント向けの地域講演者リストを作成する。'],
                ['en' => 'Launch an annual student-led innovation case competition.', 'uz' => 'Talabalar boşçiligidagi yillik innovatsion keys musobaqasini işga tuşiriş.', 'ja' => '学生主導の年次イノベーション・ケースコンペティションを開始する。'],
            ],
        ],
        'kyushu' => [
            'slug' => 'kyushu',
            'name' => ['en' => 'UAC Kyushu', 'uz' => 'UAC Kyuşu', 'ja' => 'UAC九州'],
            'short_name' => ['en' => 'Kyushu', 'uz' => 'Kyuşu', 'ja' => '九州'],
            'status' => ['en' => 'Growing Chapter', 'uz' => 'Rivojlanayotgan bölim', 'ja' => '成長中の支部'],
            'members_count' => ['en' => '45+ members', 'uz' => '45+ aʼzo', 'ja' => '45名以上のメンバー'],
            'locations' => ['en' => 'Fukuoka, Kumamoto, Kagoshima', 'uz' => 'Fukuoka, Kumamoto, Kagoşima', 'ja' => '福岡、熊本、鹿児島'],
            'summary' => [
                'en' => 'A developing chapter building stronger connections for scholars in southern Japan.',
                'uz' => 'Janubiy Yaponiyadagi olimlar uçun kuçliroq aloqalarni şakllantirayotgan rivojlanayotgan bölim.',
                'ja' => '南日本の研究者間のつながりを強化しつつある発展中の支部です。',
            ],
            'excerpt' => [
                'en' => 'A fast-growing network for scholars studying and researching in southern Japan.',
                'uz' => 'Janubiy Yaponiyada tahsil olayotgan va tadqiqot olib borayotgan olimlar uçun tez ösib borayotgan tarmoq.',
                'ja' => '南日本で学び研究する研究者のための急成長中のネットワーク。',
            ],
            'image' => 'images/regions/kyushu-card.webp',
            'hero_image' => 'images/regions/kyushu-hero.webp',
            'about' => [
                'en' => 'The Kyushu chapter is bringing together Uzbek scholars across southern Japan with a focus on academic belonging, visibility, and peer support. It serves as a flexible platform for a geographically dispersed community.',
                'uz' => 'Kyuşu bölimi janubiy Yaponiya böylab özbek olimlarini akademik mansublik, köriniş va özaro yordamga eʼtibor qaratgan holda bir joyga töplaydi. U geografik jihatdan tarqoq hamjamiyat uçun moslaşuvçan platforma vazifasini bajaradi.',
                'ja' => '九州支部は、学術的な帰属意識・可視性・仲間同士の支援を重視し、南日本各地のウズベキスタン人研究者をつなげています。地理的に分散したコミュニティのための柔軟なプラットフォームとして機能しています。',
            ],
            'universities' => [
                ['en' => 'Kyushu University', 'uz' => 'Kyuşu universiteti', 'ja' => '九州大学'],
                ['en' => 'Kumamoto University', 'uz' => 'Kumamoto universiteti', 'ja' => '熊本大学'],
                ['en' => 'Kagoshima University', 'uz' => 'Kagoşima universiteti', 'ja' => '鹿児島大学'],
                ['en' => 'Nagasaki University', 'uz' => 'Nagasaki universiteti', 'ja' => '長崎大学'],
            ],
            'activities' => [
                [
                    'title' => ['en' => 'Local Chapter Meet-up', 'uz' => 'Mahalliy bölim uçraşuvi', 'ja' => 'ローカル支部ミートアップ'],
                    'date' => ['en' => 'Quarterly', 'uz' => 'Har çorakda', 'ja' => '四半期ごと'],
                    'description' => [
                        'en' => 'Regional gatherings focused on building stronger local support networks.',
                        'uz' => 'Kuçliroq mahalliy qöllab-quvvatlaş tarmoqlarini şakllantirişga qaratilgan mintaqaviy uçraşuvlar.',
                        'ja' => 'より強固な地域支援ネットワークの構築に焦点を当てた地域交流会。',
                    ],
                ],
                [
                    'title' => ['en' => 'Research Exchange Sessions', 'uz' => 'Tadqiqot almaşinuvi sessiyalari', 'ja' => 'リサーチ・エクスチェンジ・セッション'],
                    'date' => ['en' => 'Monthly', 'uz' => 'Har oy', 'ja' => '毎月'],
                    'description' => [
                        'en' => 'Short presentations where members share current academic milestones and questions.',
                        'uz' => 'Aʼzolar joriy ilmiy yutuqlari va savollarini bölişadigan qisqa taqdimotlar.',
                        'ja' => 'メンバーが現在の学術的成果や課題を共有する短いプレゼンテーション。',
                    ],
                ],
            ],
            'secretaries' => [
                ['name' => 'Timur Ibragimov', 'role' => ['en' => 'Regional Secretary', 'uz' => 'Regional kotib', 'ja' => '地域幹事'], 'affiliation' => ['en' => 'Doctoral Candidate, Kyushu University', 'uz' => 'PhD doktorant, Kyuşu universiteti', 'ja' => '九州大学 博士課程']],
                ['name' => 'Aziza Murodova', 'role' => ['en' => 'Community Coordinator', 'uz' => 'Hamjamiyat muvofiqlaştiruvçisi', 'ja' => 'コミュニティコーディネーター'], 'affiliation' => ['en' => 'Master’s Student, Kumamoto University', 'uz' => 'Magistrant, Kumamoto universiteti', 'ja' => '熊本大学 修士課程']],
            ],
            'contact' => [
                'email' => 'kyushu@uacjp.uz',
                'phone' => '+81 (0)92-5555-0104',
                'city' => ['en' => 'Fukuoka', 'uz' => 'Fukuoka', 'ja' => '福岡'],
            ],
            'gallery' => [
                ['title' => ['en' => 'Regional orientation circle', 'uz' => 'Mintaqaviy moslaşuv doirasi', 'ja' => '地域オリエンテーションサークル'], 'tone' => 'from-secondary/85 to-primary/25'],
                ['title' => ['en' => 'Scholars networking lunch', 'uz' => 'Olimlar tarmoqlaşiş tuşligi', 'ja' => 'スカラーズ・ネットワーキング・ランチ'], 'tone' => 'from-primary/85 to-accent/35'],
                ['title' => ['en' => 'University info clinic', 'uz' => 'Universitet maʼlumot klinikasi', 'ja' => '大学インフォクリニック'], 'tone' => 'from-accent/85 to-secondary/30'],
            ],
            'plans' => [
                ['en' => 'Launch a southern Japan orientation series for incoming students.', 'uz' => 'Yangi kelayotgan talabalar uçun Janubiy Yaponiya moslaşuv seriyasini işga tuşiriş.', 'ja' => '新入生向けの南日本オリエンテーションシリーズを開始する。'],
                ['en' => 'Build stronger coordination with regional universities and city-based communities.', 'uz' => 'Mintaqaviy universitetlar va şahar hamjamiyatlari bilan kuçliroq muvofiqlaşişni yölga qöyiş.', 'ja' => '地域の大学や都市コミュニティとの連携を強化する。'],
                ['en' => 'Increase hybrid events to better serve members outside Fukuoka.', 'uz' => 'Fukuokadan taşqaridagi aʼzolarga yaxşiroq xizmat körsatiş uçun aralaş tadbirlarni köpaytiriş.', 'ja' => '福岡以外のメンバーにも対応できるようハイブリッドイベントを増やす。'],
            ],
        ],
        'tohoku-hokkaido' => [
            'slug' => 'tohoku-hokkaido',
            'name' => ['en' => 'UAC Tohoku / Hokkaido', 'uz' => 'UAC Tohoku / Hokkaydo', 'ja' => 'UAC東北・北海道'],
            'short_name' => ['en' => 'Tohoku / Hokkaido', 'uz' => 'Tohoku / Hokkaydo', 'ja' => '東北・北海道'],
            'status' => ['en' => 'Emerging Network', 'uz' => 'Yangi şakllanayotgan tarmoq', 'ja' => '新興ネットワーク'],
            'members_count' => ['en' => '25+ members', 'uz' => '25+ aʼzo', 'ja' => '25名以上のメンバー'],
            'locations' => ['en' => 'Sendai, Sapporo, Morioka', 'uz' => 'Sendai, Sapporo, Morioka', 'ja' => '仙台、札幌、盛岡'],
            'summary' => [
                'en' => 'An emerging northern network for scholars seeking stronger visibility and local peer support.',
                'uz' => 'Kuçliroq köriniş va mahalliy özaro yordamni istagan olimlar uçun yangi şakllanayotgan şimoliy tarmoq.',
                'ja' => 'より高い可視性と地元でのピアサポートを求める研究者のための新興の北日本ネットワーク。',
            ],
            'excerpt' => [
                'en' => 'An emerging northern network for Uzbek scholars across Tohoku and Hokkaido.',
                'uz' => 'Tohoku va Hokkaydo böylab özbek olimlari uçun yangi şakllanayotgan şimoliy tarmoq.',
                'ja' => '東北・北海道全域のウズベキスタン人研究者のための新興の北日本ネットワーク。',
            ],
            'image' => 'images/regions/tohoku-hokkaido-card.webp',
            'hero_image' => 'images/regions/tohoku-hokkaido-hero.webp',
            'about' => [
                'en' => 'The Tohoku / Hokkaido network supports a smaller but steadily growing member base across northern Japan. Its priority is visibility, regular communication, and ensuring that scholars outside major urban centers remain fully connected to UAC Japan.',
                'uz' => 'Tohoku / Hokkaydo tarmoği Şimoliy Yaponiya böylab kiçikroq, ammo barqaror ösib borayotgan aʼzolar bazasini qöllab-quvvatlaydi. Uning ustuvorligi — köriniş, muntazam aloqa va yirik şahar markazlaridan taşqaridagi olimlarni UAC Japan bilan töliq boğlangan holda saqlaş.',
                'ja' => '東北・北海道ネットワークは、北日本全域における小規模ながら着実に成長するメンバー基盤を支えています。優先事項は可視性、定期的なコミュニケーション、そして大都市圏以外の研究者もUAC Japanと十分につながり続けられるようにすることです。',
            ],
            'universities' => [
                ['en' => 'Tohoku University', 'uz' => 'Tohoku universiteti', 'ja' => '東北大学'],
                ['en' => 'Hokkaido University', 'uz' => 'Hokkaydo universiteti', 'ja' => '北海道大学'],
                ['en' => 'Akita University', 'uz' => 'Akita universiteti', 'ja' => '秋田大学'],
                ['en' => 'Iwate University', 'uz' => 'Ivate universiteti', 'ja' => '岩手大学'],
            ],
            'activities' => [
                [
                    'title' => ['en' => 'Virtual Northern Chapter Forum', 'uz' => 'Virtual şimoliy bölim forumi', 'ja' => 'バーチャル北日本支部フォーラム'],
                    'date' => ['en' => 'Monthly', 'uz' => 'Har oy', 'ja' => '毎月'],
                    'description' => [
                        'en' => 'An online meet-up designed to overcome distance and connect members across northern Japan.',
                        'uz' => 'Masofani yengib ötiş va Şimoliy Yaponiya böylab aʼzolarni boğlaş uçun möljallangan onlayn uçraşuv.',
                        'ja' => '距離の壁を越え、北日本全域のメンバーをつなぐために設計されたオンライン交流会。',
                    ],
                ],
                [
                    'title' => ['en' => 'Winter Research Briefings', 'uz' => 'Qişki tadqiqot brifinglari', 'ja' => '冬季リサーチブリーフィング'],
                    'date' => ['en' => 'Seasonal', 'uz' => 'Mavsumiy', 'ja' => '季節ごと'],
                    'description' => [
                        'en' => 'Short scholar updates paired with peer introductions and practical support.',
                        'uz' => 'Özaro taniştiruv va amaliy yordam bilan birga qisqa olimlar yangiliklari.',
                        'ja' => 'メンバー紹介や実践的サポートと組み合わせた短い研究者アップデート。',
                    ],
                ],
            ],
            'secretaries' => [
                ['name' => 'Daler Islomov', 'role' => ['en' => 'Regional Secretary', 'uz' => 'Regional kotib', 'ja' => '地域幹事'], 'affiliation' => ['en' => 'Research Student, Tohoku University', 'uz' => 'Tadqiqotçi talaba, Tohoku universiteti', 'ja' => '東北大学 研究生']],
                ['name' => 'Madina Khusanova', 'role' => ['en' => 'Community Liaison', 'uz' => 'Hamjamiyat aloqalari böyiça vakil', 'ja' => 'コミュニティ連携担当'], 'affiliation' => ['en' => 'Doctoral Candidate, Hokkaido University', 'uz' => 'PhD doktorant, Hokkaydo universiteti', 'ja' => '北海道大学 博士課程']],
            ],
            'contact' => [
                'email' => 'north@uacjp.uz',
                'phone' => '+81 (0)22-5555-0105',
                'city' => ['en' => 'Sendai', 'uz' => 'Sendai', 'ja' => '仙台'],
            ],
            'gallery' => [
                ['title' => ['en' => 'Virtual chapter forum', 'uz' => 'Virtual bölim forumi', 'ja' => 'バーチャル支部フォーラム'], 'tone' => 'from-primary/85 to-slate-500/30'],
                ['title' => ['en' => 'Research update session', 'uz' => 'Tadqiqot yangiliklari sessiyasi', 'ja' => 'リサーチアップデートセッション'], 'tone' => 'from-secondary/80 to-primary/25'],
                ['title' => ['en' => 'Orientation briefing', 'uz' => 'Moslaşuv brifingi', 'ja' => 'オリエンテーションブリーフィング'], 'tone' => 'from-accent/85 to-primary/30'],
            ],
            'plans' => [
                ['en' => 'Map member needs across northern universities and research institutes.', 'uz' => 'Şimoliy universitetlar va tadqiqot institutlari böylab aʼzolar ehtiyojlarini aniqlaş.', 'ja' => '北日本の大学・研究機関全体でメンバーのニーズを把握する。'],
                ['en' => 'Increase online-first engagement to support distance-based participation.', 'uz' => 'Masofadan iştirokni qöllab-quvvatlaş uçun onlayn-birinçi jalb qilişni kuçaytiriş.', 'ja' => '遠隔参加を支援するためオンライン中心の関与を強化する。'],
                ['en' => 'Develop a regional onboarding path for new arrivals in Tohoku and Hokkaido.', 'uz' => 'Tohoku va Hokkaydoga yangi kelganlar uçun mintaqaviy moslaşuv yölini işlab çiqiş.', 'ja' => '東北・北海道への新規来日者向けの地域オンボーディングプロセスを構築する。'],
            ],
        ],
    ],

    'activities' => [
        [
            'title' => ['en' => 'Scholar Symposium Tokyo 2026', 'uz' => 'Olimlar simpoziumi — Tokio 2026', 'ja' => 'スカラーシンポジウム東京2026'],
            'category' => ['en' => 'Seminars & Workshops', 'uz' => 'Seminar va treninglar', 'ja' => 'セミナー＆ワークショップ'],
            'date' => ['en' => 'October 15, 2026', 'uz' => '2026-yil 15-oktabr', 'ja' => '2026年10月15日'],
            'location' => ['en' => 'Tokyo', 'uz' => 'Tokio', 'ja' => '東京'],
            'speaker' => ['en' => 'Prof. Keiko Yamamoto', 'uz' => 'Prof. Keiko Yamamoto', 'ja' => '山本恵子教授'],
            'description' => [
                'en' => 'A flagship seminar focused on research communication, publication strategy, and interdisciplinary collaboration.',
                'uz' => 'Tadqiqot kommunikatsiyasi, naşr strategiyasi va fanlararo hamkorlikka qaratilgan yetakçi seminar.',
                'ja' => '研究コミュニケーション、論文出版戦略、学際協力に焦点を当てた主要セミナー。',
            ],
        ],
        [
            'title' => ['en' => 'Research Methods Clinic', 'uz' => 'Tadqiqot metodologiyasi klinikasi', 'ja' => '研究手法クリニック'],
            'category' => ['en' => 'Seminars & Workshops', 'uz' => 'Seminar va treninglar', 'ja' => 'セミナー＆ワークショップ'],
            'date' => ['en' => 'November 6, 2026', 'uz' => '2026-yil 6-noyabr', 'ja' => '2026年11月6日'],
            'location' => ['en' => 'Online', 'uz' => 'Onlayn', 'ja' => 'オンライン'],
            'speaker' => ['en' => 'Dr. Akmal Karimov', 'uz' => 'Dr. Akmal Karimov', 'ja' => 'アクマル・カリモフ博士'],
            'description' => [
                'en' => 'Hands-on sessions helping postgraduate members refine methodology, data design, and proposal framing.',
                'uz' => 'Magistrant va doktorant aʼzolarga metodologiya, maʼlumotlar dizayni va taklif tuzişni takomillaştirişga yordam beruvçi amaliy sessiyalar.',
                'ja' => '大学院生メンバーが研究手法、データ設計、提案書の構成を磨くための実践セッション。',
            ],
        ],
        [
            'title' => ['en' => 'Uzbek Scholars Forum in Japan', 'uz' => 'Yaponiyadagi özbek olimlari forumi', 'ja' => '在日ウズベキスタン人研究者フォーラム'],
            'category' => ['en' => 'Conferences & Forums', 'uz' => 'Konferensiya va forumlar', 'ja' => 'カンファレンス＆フォーラム'],
            'date' => ['en' => 'December 3, 2026', 'uz' => '2026-yil 3-dekabr', 'ja' => '2026年12月3日'],
            'location' => ['en' => 'Kyoto', 'uz' => 'Kioto', 'ja' => '京都'],
            'speaker' => null,
            'description' => [
                'en' => 'A multi-panel gathering bringing together scholars, alumni, and institutional guests for strategic dialogue.',
                'uz' => 'Strategik muloqot uçun olimlar, bitiruvçilar va institutsional mehmonlarni bir joyga töplaydigan köp panelli yiğin.',
                'ja' => '研究者、卒業生、機関関係者が戦略的対話のために集う複数パネル形式の会合。',
            ],
        ],
        [
            'title' => ['en' => 'Industry-Academia Collaboration Day', 'uz' => 'Sanoat-akademiya hamkorlik kuni', 'ja' => '産学連携デー'],
            'category' => ['en' => 'Research Collaboration', 'uz' => 'Tadqiqot hamkorligi', 'ja' => '研究協力'],
            'date' => ['en' => 'September 24, 2026', 'uz' => '2026-yil 24-sentabr', 'ja' => '2026年9月24日'],
            'location' => ['en' => 'Nagoya', 'uz' => 'Nagoya', 'ja' => '名古屋'],
            'speaker' => ['en' => 'Innovation partner roundtable', 'uz' => 'Innovatsion hamkorlar davra suhbati', 'ja' => 'イノベーションパートナー円卓会議'],
            'description' => [
                'en' => 'Meet potential collaborators from universities, incubators, and applied research environments.',
                'uz' => 'Universitetlar, inkubatorlar va amaliy tadqiqot muhitidagi potentsial hamkorlar bilan uçraşing.',
                'ja' => '大学、インキュベーター、応用研究分野の潜在的な協力者と出会う機会。',
            ],
        ],
        [
            'title' => ['en' => 'Cross-Regional Peer Review Circle', 'uz' => 'Mintaqalararo özaro taqriz doirasi', 'ja' => '地域横断ピアレビューサークル'],
            'category' => ['en' => 'Research Collaboration', 'uz' => 'Tadqiqot hamkorligi', 'ja' => '研究協力'],
            'date' => ['en' => 'Monthly', 'uz' => 'Har oy', 'ja' => '毎月'],
            'location' => ['en' => 'Hybrid', 'uz' => 'Aralaş', 'ja' => 'ハイブリッド'],
            'speaker' => null,
            'description' => [
                'en' => 'Structured peer review sessions for journal papers, theses, conference abstracts, and research presentations.',
                'uz' => 'Jurnal maqolalari, dissertatsiyalar, konferensiya tezislari va tadqiqot taqdimotlari uçun tuzilgan özaro taqriz sessiyalari.',
                'ja' => '学術論文、学位論文、学会要旨、研究発表のための構造化されたピアレビューセッション。',
            ],
        ],
        [
            'title' => ['en' => 'Autumn Networking Evening', 'uz' => 'Kuzgi tarmoqlaşiş keçasi', 'ja' => '秋のネットワーキングイブニング'],
            'category' => ['en' => 'Cultural & Networking Events', 'uz' => 'Madaniy va tarmoqlaşiş tadbirlari', 'ja' => '文化・交流イベント'],
            'date' => ['en' => 'October 28, 2026', 'uz' => '2026-yil 28-oktabr', 'ja' => '2026年10月28日'],
            'location' => ['en' => 'Osaka', 'uz' => 'Osaka', 'ja' => '大阪'],
            'speaker' => null,
            'description' => [
                'en' => 'A relaxed regional event designed to connect new students, senior scholars, and partners in an informal setting.',
                'uz' => 'Yangi talabalar, tajribali olimlar va hamkorlarni norasmiy muhitda boğlaş uçun möljallangan erkin mintaqaviy tadbir.',
                'ja' => '新入生、シニア研究者、パートナーがカジュアルな雰囲気でつながるためのリラックスした地域イベント。',
            ],
        ],
        [
            'title' => ['en' => 'Past Events Archive Launch', 'uz' => 'Ötgan tadbirlar arxivi işga tuşirilişi', 'ja' => '過去イベントアーカイブ公開'],
            'category' => ['en' => 'Past Events Archive', 'uz' => 'Ötgan tadbirlar arxivi', 'ja' => '過去イベントアーカイブ'],
            'date' => ['en' => 'Archive', 'uz' => 'Arxiv', 'ja' => 'アーカイブ'],
            'location' => ['en' => 'Digital library', 'uz' => 'Raqamli kutubxona', 'ja' => 'デジタルライブラリー'],
            'speaker' => null,
            'description' => [
                'en' => 'An indexed archive of prior lectures, workshops, and community initiatives for member reference.',
                'uz' => 'Aʼzolar uçun oldingi maʼruzalar, treninglar va hamjamiyat taşabbuslarining indekslangan arxivi.',
                'ja' => 'メンバー向けに過去の講義、ワークショップ、コミュニティ活動をインデックス化したアーカイブ。',
            ],
        ],
    ],

    // Real UAC officers. `type` groups them on the Members page:
    // Executive → Executive Body, Ambassador → regional ambassadors, Staff → roles.
    // Photos and affiliations arrive from the client; empty values are hidden.
    'members' => [
        [
            'name' => 'Umirdinov Alisher',
            'photo' => null,
            'role' => ['en' => 'Chief Advisor', 'uz' => 'Boş maslahatçi', 'ja' => '主席顧問'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'type' => 'Executive',
            'sort_order' => 1,
        ],
        [
            'name' => 'Umida Ashurova',
            'photo' => null,
            'role' => ['en' => 'Advisor', 'uz' => 'Maslahatçi', 'ja' => '顧問'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'type' => 'Executive',
            'sort_order' => 2,
        ],
        [
            'name' => 'Abdurashid Mavlanov',
            'photo' => null,
            'role' => ['en' => 'Advisor', 'uz' => 'Maslahatçi', 'ja' => '顧問'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'type' => 'Executive',
            'sort_order' => 3,
        ],
        [
            'name' => 'Abdujabborov Ibrohimjon Baxtiyor oʻgʻli',
            'photo' => 'images/members/ibrohimjon-abdujabborov.webp',
            'role' => ['en' => 'Kanto Region Ambassador', 'uz' => 'Kanto hududi ambassadori', 'ja' => '関東地域アンバサダー'],
            'affiliation' => [
                'en' => 'Tokyo University of Foreign Studies',
                'uz' => 'Tokio xorijiy tillar universiteti',
                'ja' => '東京外国語大学',
            ],
            'bio' => [
                'en' => "Born in Toʻraqoʻrgʻon District, Namangan Region. Completed bachelor's and master's studies at Tashkent State University of Oriental Studies.\n\nIn 2022, won the Japanese government's prestigious MEXT scholarship and continued master's studies at the Tokyo University of Foreign Studies.\n\nCurrently a doctoral student at the same university, researching the social adaptation, life satisfaction, and future career plans of Uzbek labour migrants in Japan.\n\nFounder and head of the JLPT MASTER Japanese language centre. Works across education, academic cooperation, and labour migration between Japan and Uzbekistan.",
                'uz' => "Namangan viloyatining Töraqörğon tumanida tuğilgan. Toşkent davlat şarqşunoslik universitetida bakalavriat va magistratura bosqiçlarida tahsil olgan.\n\n2022-yilda Yaponiya hukumatining nufuzli MEXT stipendiyasi ğolibi bölib, Tokio xorijiy tillar universitetida (Tokyo University of Foreign Studies) magistratura bosqiçida öqişini davom ettirgan.\n\nHozirda mazkur universitetning doktorantura bosqiçida tahsil olib, Yaponiyadagi özbekistonlik mehnat migrantlarining ijtimoiy moslaşuvi, hayotdan qoniqiş darajasi va kelgusidagi kasbiy rejalari böyiça ilmiy izlanişlar olib bormoqda.\n\nJLPT MASTER yapon tili taʼlim markazi asosçisi va rahbari. Yaponiya va Özbekiston örtasidagi taʼlim, ilmiy-akademik hamkorlik hamda mehnat migratsiyasi sohalarida faoliyat yuritib kelmoqda.",
                'ja' => "ナマンガン州トゥラコルゴン地区生まれ。タシケント国立東洋学大学で学士課程および修士課程を修了。\n\n2022年、日本政府の文部科学省（MEXT）奨学金に選ばれ、東京外国語大学の修士課程で学業を継続。\n\n現在は同大学の博士課程に在籍し、在日ウズベキスタン人労働移民の社会適応、生活満足度、今後のキャリア計画について研究を行っている。\n\n日本語教育機関「JLPT MASTER」の創設者兼代表。日本とウズベキスタンの間の教育、学術連携、労働移民の分野で活動している。",
            ],
            'region' => ['en' => 'Kanto', 'uz' => 'Kanto', 'ja' => '関東'],
            'region_slug' => 'kanto',
            'type' => 'Ambassador',
            'sort_order' => 1,
        ],
        [
            'name' => 'Otabek Buriev',
            'photo' => null,
            'role' => ['en' => 'Chubu Region Ambassador', 'uz' => 'Çubu hududi ambassadori', 'ja' => '中部地域アンバサダー'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'region' => ['en' => 'Chubu', 'uz' => 'Çubu', 'ja' => '中部'],
            'region_slug' => 'chubu',
            'type' => 'Ambassador',
            'sort_order' => 2,
        ],
        [
            'name' => 'Nodira Umaralieva',
            'photo' => null,
            'role' => ['en' => 'Secretary', 'uz' => 'Kotib', 'ja' => '書記'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'type' => 'Staff',
            'sort_order' => 1,
        ],
        [
            'name' => 'Raximov Anvarbek',
            'photo' => null,
            'role' => ['en' => 'Website Editor', 'uz' => 'Sayt muharriri', 'ja' => 'ウェブサイト編集担当'],
            'affiliation' => ['en' => '', 'uz' => '', 'ja' => ''],
            'type' => 'Staff',
            'sort_order' => 2,
        ],
        [
            'name' => 'Jamoliddinov Asadbek Odiljon öğli',
            'photo' => 'images/members/asadbek-jamoliddinov.webp',
            'role' => ['en' => 'External Relations', 'uz' => 'Taşqi aloqalar böyiça', 'ja' => '渉外担当'],
            'affiliation' => [
                'en' => 'Hitotsubashi University',
                'uz' => 'Xitotsubaşi universiteti',
                'ja' => '一橋大学',
            ],
            'bio' => [
                'en' => "Born in 2001 in Rishton District, Fergana Region. Completed the IIGE program in international cooperation and joint education at Kansai University, Japan, in 2022. In 2023–2024, on the recommendation of the Embassy of Japan in the Republic of Uzbekistan, studied at Keio University on a MEXT scholarship from the Japanese government. Graduated from the Higher School of Japanese Studies at Tashkent State University of Oriental Studies in 2025, and since 2026 has been continuing research at Hitotsubashi University in Japan on a MEXT scholarship.\n\nWinner of national and international Japanese-language public speaking competitions, and a two-time Mitsubishi scholarship recipient.",
                'uz' => "2001 yilda Farğona viloyatining Rişton tumanida tuğilgan. 2022 yilda Yaponiyaning Kansai universitetida xalqaro hamkorlik va qöşma taʼlimga asoslangan IIGE dasturini tamomlagan. 2023–2024 yillarda Özbekiston Respublikasidagi Yaponiya elçixonasining tavsiyasi asosida Yaponiya hukumatining MEXT stipendiyasi bilan Keyo universitetida tahsil olgan. 2025 yilda Toşkent davlat şarqşunoslik universitetining Yaponşunoslik oliy maktabini bitirib, 2026 yildan buyon MEXT stipendiyasi asosida Yaponiyaning Xitotsubaşi universitetida ilmiy izlanişlarini davom ettirmoqda.\n\nYapon tilida notiqlik sanʼati böyiça respublika va xalqaro tanlovlar ğolibi, 2 karra «Mitsubişi» stipendiyasi sohibi.",
                'ja' => "2001年、フェルガナ州リシュタン地区生まれ。2022年、日本の関西大学で国際連携・共同教育に基づくIIGEプログラムを修了。2023〜2024年には、在ウズベキスタン日本国大使館の推薦により、日本政府のMEXT（文部科学省）奨学金で慶應義塾大学に留学。2025年にタシケント国立東洋学大学の日本学スクールを卒業し、2026年からはMEXT奨学金により日本の一橋大学で研究を続けている。\n\n日本語弁論の国内大会および国際大会での優勝者であり、三菱奨学金を2度受給。",
            ],
            'type' => 'Staff',
            'sort_order' => 3,
        ],
    ],

    'secretary_members' => [
        'national' => [
            ['name' => 'Dr. Alisher Usmanov', 'role' => ['en' => 'President', 'uz' => 'Prezident', 'ja' => '会長'], 'affiliation' => ['en' => 'The University of Tokyo', 'uz' => 'Tokio universiteti', 'ja' => '東京大学'], 'field' => ['en' => 'Applied Physics', 'uz' => 'Amaliy fizika', 'ja' => '応用物理学'], 'contact' => 'president@uacjp.uz'],
            ['name' => 'Nargiza Karimova', 'role' => ['en' => 'Vice President', 'uz' => 'Vitse-prezident', 'ja' => '副会長'], 'affiliation' => ['en' => 'Kyoto University', 'uz' => 'Kioto universiteti', 'ja' => '京都大学'], 'field' => ['en' => 'International Relations', 'uz' => 'Xalqaro munosabatlar', 'ja' => '国際関係学'], 'contact' => 'vicepresident@uacjp.uz'],
            ['name' => 'Rustam Rakhimov', 'role' => ['en' => 'Secretary General', 'uz' => 'Boş kotib', 'ja' => '事務局長'], 'affiliation' => ['en' => 'Osaka University', 'uz' => 'Osaka universiteti', 'ja' => '大阪大学'], 'field' => ['en' => 'Computer Science', 'uz' => 'Kompyuter fanlari', 'ja' => 'コンピュータサイエンス'], 'contact' => 'secretary@uacjp.uz'],
            ['name' => 'Kamola Iskandarova', 'role' => ['en' => 'Treasurer', 'uz' => 'Xazinaçi', 'ja' => '会計担当'], 'affiliation' => ['en' => 'Nagoya University', 'uz' => 'Nagoya universiteti', 'ja' => '名古屋大学'], 'field' => ['en' => 'Economics', 'uz' => 'Iqtisodiyot', 'ja' => '経済学'], 'contact' => 'treasurer@uacjp.uz'],
        ],
        'regional' => [
            ['name' => 'Dilshod Abdullaev', 'role' => ['en' => 'Kanto Secretary', 'uz' => 'Kanto kotibi', 'ja' => '関東幹事'], 'affiliation' => ['en' => 'Waseda University', 'uz' => 'Vaseda universiteti', 'ja' => '早稲田大学'], 'field' => ['en' => 'Computer Science', 'uz' => 'Kompyuter fanlari', 'ja' => 'コンピュータサイエンス'], 'contact' => 'kanto@uacjp.uz'],
            ['name' => 'Malika Rustamova', 'role' => ['en' => 'Kansai Secretary', 'uz' => 'Kansai kotibi', 'ja' => '関西幹事'], 'affiliation' => ['en' => 'Kobe University', 'uz' => 'Kobe universiteti', 'ja' => '神戸大学'], 'field' => ['en' => 'Education Policy', 'uz' => 'Taʼlim siyosati', 'ja' => '教育政策'], 'contact' => 'kansai@uacjp.uz'],
            ['name' => 'Nilufar Ergasheva', 'role' => ['en' => 'Chubu Secretary', 'uz' => 'Çubu kotibi', 'ja' => '中部幹事'], 'affiliation' => ['en' => 'Nagoya University', 'uz' => 'Nagoya universiteti', 'ja' => '名古屋大学'], 'field' => ['en' => 'Materials Science', 'uz' => 'Materialşunoslik', 'ja' => '材料科学'], 'contact' => 'chubu@uacjp.uz'],
            ['name' => 'Timur Ibragimov', 'role' => ['en' => 'Kyushu Secretary', 'uz' => 'Kyuşu kotibi', 'ja' => '九州幹事'], 'affiliation' => ['en' => 'Kyushu University', 'uz' => 'Kyuşu universiteti', 'ja' => '九州大学'], 'field' => ['en' => 'Mechanical Engineering', 'uz' => 'Mexanika muhandisligi', 'ja' => '機械工学'], 'contact' => 'kyushu@uacjp.uz'],
        ],
    ],

    'about' => [
        'intro' => [
            'title' => [
                'en' => 'A scholarly community uniting Uzbek students and researchers in Japan',
                'uz' => 'Yaponiyadagi özbek talabalari va tadqiqotçilarini birlaştiruvçi ilmiy hamjamiyat',
                'ja' => '日本のウズベキスタン人学生・研究者をつなぐ学術コミュニティ',
            ],
            'lead' => [
                [
                    'en' => 'Uzbek Academic Club is an academic community that helps our compatriots who study, conduct research, or are passionate about science in Japan exchange knowledge, experience, and ideas. The club brings together students, master’s and doctoral students, and researchers from many fields on a shared platform, fostering scholarly dialogue and collaboration among them.',
                    'uz' => 'Uzbek Academic Club — Yaponiyada taʼlim olayotgan, ilmiy izlaniş olib borayotgan va ilm-fanga qiziqadigan yurtdoşlarimiz örtasida bilim, tajriba va ğoyalar almaşişga xizmat qiluvçi akademik hamjamiyatdir. Klub talabalar, magistrantlar, doktorantlar va turli sohalardagi tadqiqotçilarni bir maydonda birlaştirib, ular örtasida ilmiy muloqot va hamkorlikni rivojlantirib kelmoqda.',
                    'ja' => 'Uzbek Academic Clubは、日本で学び、研究に取り組み、学問に関心を持つ同胞が知識・経験・アイデアを交換するための学術コミュニティです。学部生、修士・博士課程の学生、さまざまな分野の研究者が一堂に会し、学術的な対話と協力を育んでいます。',
                ],
                [
                    'en' => 'Active for three years, the club holds its meetings in different regions of Japan. Gatherings in Kanto, Kansai, and Nagoya, as well as a meeting in Hokkaido, have helped connect compatriots across universities and regions. Through these meetings, participants meet new people and learn from one another’s research and experience.',
                    'uz' => 'Uç yildan beri samarali faoliyat olib borayotgan klubning uçraşuvlari Yaponiyaning turli hududlarida taşkil etiladi. Kanto, Kansai va Nagoyada ötkazilgan tadbirlar, şuningdek, Hokkaidoda bölib ötgan uçraşuv turli universitet va hududlardagi yurtdoşlarimizni özaro boğlaşga xizmat qilgan. Bu uçraşuvlar orqali iştirokçilar yangi insonlar bilan tanişib, bir-birining ilmiy izlanişlari va tajribalaridan örganib kelmoqda.',
                    'ja' => '3年間にわたり活動を続けてきたクラブは、日本各地で例会を開催しています。関東・関西・名古屋での催しや北海道での例会は、さまざまな大学や地域の同胞を結びつけてきました。参加者はこうした例会を通じて新たな出会いを得て、互いの研究や経験から学び合っています。',
                ],
            ],
            'sections' => [
                [
                    'heading' => [
                        'en' => 'Sharing research and learning together',
                        'uz' => 'Ilmiy izlanişlarni baham köriş va birgalikda örganiş',
                        'ja' => '研究を共有し、共に学ぶ',
                    ],
                    'paragraphs' => [
                        [
                            'en' => 'One of the club’s core activities is giving researchers the opportunity to present their work and exchange views on it. At our meetings, we hear research presentations from a wide range of fields and discuss research questions, approaches, and findings. Participants can ask questions, share their perspectives, and look at research from a different point of view.',
                            'uz' => 'Klub faoliyatining asosiy yönalişlaridan biri — tadqiqotçilarga öz ilmiy işlarini taniştiriş va ular yuzasidan fikr almaşiş imkoniyatini yaratişdir. Uçraşuvlarda turli sohalarga oid ilmiy taqdimotlar tinglanadi, tadqiqot savollari, yondaşuvlar va natijalar muhokama qilinadi. Iştirokçilar savol beriş, öz qaraşlarini bildiriş hamda tadqiqotga boşqa nuqtayi nazardan qaraş imkoniga ega böladilar.',
                            'ja' => 'クラブの中心的な活動の一つは、研究者が自らの研究を発表し、意見を交わす機会をつくることです。例会では多様な分野の研究発表が行われ、研究課題、アプローチ、成果について議論します。参加者は質問をしたり、自分の見解を述べたり、別の視点から研究を捉え直したりすることができます。',
                        ],
                        [
                            'en' => 'Topics spanning the social sciences, international relations, law, education, technology, and energy bring diversity to the conversations in our community. Discussing research from one field with people from other fields creates the ground for new questions, ideas, and collaborations.',
                            'uz' => 'Ijtimoiy fanlar, xalqaro munosabatlar, huquq, taʼlim, texnologiya va energetika kabi turli yönalişlardagi mavzular hamjamiyatdagi muloqotga xilma-xillik beradi. Bir sohadagi izlanişning boşqa soha vakillari bilan muhokama qilinişi yangi savollar, ğoyalar va hamkorliklar uçun zamin yaratadi.',
                            'ja' => '社会科学、国際関係、法学、教育、テクノロジー、エネルギーなど多岐にわたるテーマが、コミュニティでの対話に多様性をもたらしています。ある分野の研究を他分野の人々と議論することが、新たな問い、アイデア、協力の土台となります。',
                        ],
                    ],
                ],
                [
                    'heading' => [
                        'en' => 'Sharing experience and supporting one another',
                        'uz' => 'Tajriba almaşiş va özaro qöllab-quvvatlaş',
                        'ja' => '経験の共有と相互支援',
                    ],
                    'paragraphs' => [
                        [
                            'en' => 'Studying and doing research in Japan brings everyone their own questions and challenges. Club meetings offer a welcoming space to share these experiences, learn from each other, and get advice. Young people just starting out in academia can talk with more experienced researchers and discuss their interests and future plans.',
                            'uz' => 'Yaponiyada öqiş va tadqiqot olib boriş jarayonida har bir inson turli savollar va qiyinçiliklarga duç keladi. Klub uçraşuvlari ana şu tajribalarni özaro baham köriş, bir-biridan örganiş va maslahat oliş uçun ham qulay muhit yaratadi. Ilmiy faoliyatini endi boşlayotgan yoşlar tajribaliroq tadqiqotçilar bilan muloqot qiliş, öz qiziqişlari va kelgusi rejalari haqida fikrlaşiş imkoniga ega böladilar.',
                            'ja' => '日本で学び、研究を進める中で、誰もがさまざまな疑問や困難に直面します。クラブの例会は、そうした経験を分かち合い、互いに学び、助言を得られる場でもあります。研究の道を歩み始めたばかりの若手は、経験豊富な研究者と対話し、自らの関心や将来の計画について語り合うことができます。',
                        ],
                        [
                            'en' => 'Alongside research presentations, book launches, themed discussions, and informal get-togethers are an important part of the club’s life. These conversations strengthen ties among our compatriots and, together with academic collaboration, help mutual trust and friendship grow.',
                            'uz' => 'Ilmiy taqdimotlar bilan bir qatorda, kitob taqdimotlari, mavzuli suhbatlar va samimiy uçraşuvlar ham klub faoliyatining muhim qismini taşkil etadi. Bunday muloqotlar yurtdoşlarimiz örtasidagi aloqalarni mustahkamlab, akademik hamkorlik bilan birga özaro işonç va döstlikning rivojlanişiga xizmat qiladi.',
                            'ja' => '研究発表に加え、出版記念の紹介、テーマ別の座談会、気軽な交流会もクラブ活動の重要な一部です。こうした交流は同胞同士のつながりを深め、学術的な協力とともに相互の信頼と友情を育んでいます。',
                        ],
                    ],
                ],
                [
                    'heading' => [
                        'en' => 'Our goal',
                        'uz' => 'Bizning maqsadimiz',
                        'ja' => '私たちの目標',
                    ],
                    'paragraphs' => [
                        [
                            'en' => 'The goal of Uzbek Academic Club is to foster ongoing scholarly dialogue among Uzbek students and researchers in Japan, support the exchange of knowledge and experience, and open the way to new collaborations. We believe that every participant’s experience, questions, and ideas are valuable to the community.',
                            'uz' => 'Uzbek Academic Clubning maqsadi — Yaponiyadagi özbek talabalari va tadqiqotçilari örtasida davomiy ilmiy muloqotni rivojlantiriş, bilim va tajriba almaşişni qöllab-quvvatlaş hamda yangi hamkorliklarga yöl oçişdir. Biz har bir iştirokçining tajribasi, savoli va ğoyasi hamjamiyat uçun qadrli, deb hisoblaymiz.',
                            'ja' => 'Uzbek Academic Clubの目標は、日本のウズベキスタン人学生・研究者の間で継続的な学術対話を育み、知識と経験の交換を支え、新たな協力への道を開くことです。私たちは、参加者一人ひとりの経験、問い、アイデアがコミュニティにとってかけがえのないものだと考えています。',
                        ],
                        [
                            'en' => 'Going forward, we will continue to bring together compatriots from different regions, encourage young researchers to take an active part, and widen an open space for dialogue for everyone interested in science.',
                            'uz' => 'Kelgusida ham turli hududlardagi yurtdoşlarimizni birlaştiriş, yoş tadqiqotçilarning faol iştirokini rağbatlantiriş va ilmga qiziqadigan insonlar uçun oçiq muloqot muhitini kengaytirişga intilamiz.',
                            'ja' => '今後も、各地の同胞を結びつけ、若手研究者の積極的な参加を後押しし、学問に関心を持つすべての人に開かれた対話の場を広げていきます。',
                        ],
                    ],
                ],
            ],
            'closing' => [
                'en' => 'If you are interested in science and want to share your research, gain new knowledge, and meet like-minded people — join our community!',
                'uz' => 'Ilmga qiziqsangiz, öz izlanişlaringizni baham köriş, yangi bilim oliş va hamfikrlar bilan tanişişni istasangiz — hamjamiyatimizga qöşiling!',
                'ja' => '学問に関心があり、研究を共有し、新たな知識を得て、志を同じくする仲間と出会いたい方は、ぜひ私たちのコミュニティにご参加ください！',
            ],
        ],
        'history' => [
            'en' => 'UAC Japan was founded to unify a growing community of Uzbek students, doctoral researchers, postdoctoral fellows, and alumni across Japanese universities. It began as an informal network and is now evolving into a more structured academic platform.',
            'uz' => 'UAC Japan Yaponiya universitetlaridagi özbek talabalari, doktorant-tadqiqotçilari, postdoktorantlari va bitiruvçilarining ösib borayotgan hamjamiyatini birlaştiriş uçun taşkil etilgan. U norasmiy tarmoq sifatida boşlangan va hozirda yanada tizimlaştirilgan akademik platformaga aylanib bormoqda.',
            'ja' => 'UAC Japanは、日本各地の大学で学ぶウズベキスタン人学生、博士課程研究者、博士研究員、卒業生からなる拡大するコミュニティを統合するために設立されました。非公式なネットワークとして始まり、現在ではより体系化された学術プラットフォームへと発展しています。',
        ],
        'values' => [
            ['en' => 'Academic integrity and intellectual openness', 'uz' => 'Ilmiy halollik va intellektual oçiqlik', 'ja' => '学術的誠実さと知的な開放性'],
            ['en' => 'Mutual support across generations of scholars', 'uz' => 'Olimlar avlodlari örtasida özaro yordam', 'ja' => '世代を超えた研究者間の相互支援'],
            ['en' => 'Constructive collaboration with Japanese and international partners', 'uz' => 'Yapon va xalqaro hamkorlar bilan konstruktiv hamkorlik', 'ja' => '日本および国際パートナーとの建設的な協力'],
            ['en' => 'Professional excellence with cultural responsibility', 'uz' => 'Madaniy masʼuliyat bilan uyğunlaşgan professional mukammallik', 'ja' => '文化的責任感を伴う専門的卓越性'],
        ],
        'structure' => [
            ['en' => 'National Executive Board coordinating strategy and partnerships', 'uz' => 'Strategiya va hamkorlikni muvofiqlaştiruvçi Milliy Ijroiya Kengaşi', 'ja' => '戦略とパートナーシップを統括する全国執行委員会'],
            ['en' => 'Regional chapters responding to local member needs', 'uz' => 'Mahalliy aʼzolar ehtiyojlariga javob beruvçi mintaqaviy bölimlar', 'ja' => '地域メンバーのニーズに応える地域支部'],
            ['en' => 'Activity leads focused on research, events, and communications', 'uz' => 'Tadqiqot, tadbirlar va aloqalarga eʼtibor qaratgan faoliyat rahbarlari', 'ja' => '研究・イベント・広報を担当する活動リーダー'],
        ],
        'president_message' => [
            'en' => 'UAC Japan exists to make every Uzbek scholar in Japan feel connected, visible, and supported. We are building a community that values rigorous scholarship, practical mentorship, and long-term partnerships that benefit both our members and the wider academic ecosystem.',
            'uz' => 'UAC Japan Yaponiyadagi har bir özbek olimini boğlangan, körinadigan va qöllab-quvvatlangan his qildiriş uçun mavjud. Biz qatʼiy ilmiylik, amaliy murabbiylik va aʼzolarimiz hamda kengroq ilmiy ekotizimga foyda keltiradigan uzoq muddatli hamkorlikni qadrlaydigan hamjamiyat qurmoqdamiz.',
            'ja' => 'UAC Japanは、日本のすべてのウズベキスタン人研究者がつながりを感じ、可視化され、支援されるために存在します。私たちは、厳密な学術性、実践的なメンタリング、そしてメンバーと学術エコシステム全体の両方に利益をもたらす長期的なパートナーシップを重視するコミュニティを築いています。',
        ],
    ],

    'partners' => [
        'sponsors' => [
            ['name' => 'Academic Bridges Foundation', 'type' => ['en' => 'Sponsor', 'uz' => 'Homiy', 'ja' => 'スポンサー'], 'description' => ['en' => 'Supports scholar mobility and student-facing academic initiatives.', 'uz' => 'Olimlar mobilligini va talabalarga yönaltirilgan ilmiy taşabbuslarni qöllab-quvvatlaydi.', 'ja' => '研究者の流動性と学生向けの学術イニシアチブを支援します。']],
            ['name' => 'Future Research Lab', 'type' => ['en' => 'Sponsor', 'uz' => 'Homiy', 'ja' => 'スポンサー'], 'description' => ['en' => 'Provides outreach support for seminars and collaboration sessions.', 'uz' => 'Seminar va hamkorlik sessiyalari uçun tarğibot yordamini taqdim etadi.', 'ja' => 'セミナーや協力セッションのためのアウトリーチ支援を提供します。']],
            ['name' => 'Japan-Uzbek Innovation Forum', 'type' => ['en' => 'Sponsor', 'uz' => 'Homiy', 'ja' => 'スポンサー'], 'description' => ['en' => 'Connects researchers with innovation and policy stakeholders.', 'uz' => 'Tadqiqotçilarni innovatsiya va siyosat manfaatdor tomonlari bilan boğlaydi.', 'ja' => '研究者をイノベーションおよび政策の関係者と結びつけます。']],
        ],
        'networks' => [
            ['name' => 'Japanese Universities Network', 'type' => ['en' => 'Academic Network', 'uz' => 'Ilmiy tarmoq', 'ja' => '学術ネットワーク'], 'description' => ['en' => 'A growing set of universities connected through regional chapter activities.', 'uz' => 'Mintaqaviy bölim faoliyati orqali boğlangan, ösib borayotgan universitetlar töplami.', 'ja' => '地域支部の活動を通じてつながる、拡大する大学群。']],
            ['name' => 'Research Institutes Alliance', 'type' => ['en' => 'Research Institute', 'uz' => 'Tadqiqot instituti', 'ja' => '研究機関'], 'description' => ['en' => 'Supports interdisciplinary engagement and applied research cooperation.', 'uz' => 'Fanlararo hamkorlik va amaliy tadqiqot kooperatsiyasini qöllab-quvvatlaydi.', 'ja' => '学際的な関与と応用研究協力を支援します。']],
            ['name' => 'International Scholar Partners', 'type' => ['en' => 'International Partner', 'uz' => 'Xalqaro hamkor', 'ja' => '国際パートナー'], 'description' => ['en' => 'Collaborates on knowledge-sharing, outreach, and mobility opportunities.', 'uz' => 'Bilim almaşiş, tarğibot va mobillik imkoniyatlari böyiça hamkorlik qiladi.', 'ja' => '知識共有、アウトリーチ、流動性の機会に関して協力します。']],
        ],
        'prospective' => [
            [
                'name' => [
                    'en' => 'Embassy of the Republic of Uzbekistan in Japan',
                    'uz' => 'Özbekiston Respublikasining Yaponiyadagi elçixonasi',
                    'ja' => '在日ウズベキスタン共和国大使館',
                ],
                'type' => ['en' => 'Diplomatic Mission', 'uz' => 'Diplomatik vakolatxona', 'ja' => '外交使節団'],
                'logo' => 'images/partners/embassy-of-uzbekistan-japan.webp',
                'description' => [
                    'en' => 'Hosts community gatherings and supports academic and cultural initiatives of Uzbek scholars in Japan.',
                    'uz' => 'Hamjamiyat uçraşuvlarini qabul qiladi hamda Yaponiyadagi özbek olimlarining ilmiy va madaniy taşabbuslarini qöllab-quvvatlaydi.',
                    'ja' => 'コミュニティの集まりを受け入れ、日本におけるウズベキスタン人研究者の学術・文化活動を支援しています。',
                ],
            ],
            [
                'name' => [
                    'en' => 'Ministry of Higher Education, Science and Innovation of Uzbekistan',
                    'uz' => 'Özbekiston Respublikasi Oliy taʼlim, fan va innovatsiyalar vazirligi',
                    'ja' => 'ウズベキスタン共和国高等教育・科学・イノベーション省',
                ],
                'type' => ['en' => 'Government Institution', 'uz' => 'Davlat muassasasi', 'ja' => '政府機関'],
                'logo' => 'images/partners/ministry-of-higher-education-uz.webp',
                'description' => [
                    'en' => 'Shapes higher education and research policy, and connects Uzbek universities with scholars abroad.',
                    'uz' => 'Oliy taʼlim va ilm-fan siyosatini şakllantiradi hamda özbek universitetlarini xorijdagi olimlar bilan boğlaydi.',
                    'ja' => '高等教育・研究政策を担い、ウズベキスタンの大学と海外の研究者をつなぎます。',
                ],
            ],
            [
                'name' => [
                    'en' => '“Vatandoshlar” Public Foundation',
                    'uz' => '“Vatandoşlar” jamoat fondi',
                    'ja' => '「ヴァタンドシュラル」公共基金',
                ],
                'type' => ['en' => 'Public Foundation', 'uz' => 'Jamoat fondi', 'ja' => '公共基金'],
                'logo' => 'images/partners/vatandoshlar-public-foundation.webp',
                'description' => [
                    'en' => 'Works with Uzbek communities abroad and supports compatriot initiatives, including academic networks.',
                    'uz' => 'Xorijdagi özbek diasporasi bilan işlaydi va vatandoşlarning, jumladan ilmiy tarmoqlarning taşabbuslarini qöllab-quvvatlaydi.',
                    'ja' => '海外のウズベキスタン人コミュニティと連携し、学術ネットワークを含む同胞の取り組みを支援しています。',
                ],
            ],
            [
                'name' => [
                    'en' => 'WAYU — World Association of Uzbek Youth',
                    'uz' => 'WAYU — Özbekiston Yoşlari Umumjahon Assotsiatsiyasi',
                    'ja' => 'WAYU — ウズベキスタン青年世界協会',
                ],
                'type' => ['en' => 'Youth Association', 'uz' => 'Yoşlar assotsiatsiyasi', 'ja' => '青年協会'],
                'logo' => 'images/partners/wayu-uzbekistan-youth-association.webp',
                'description' => [
                    'en' => 'Unites young Uzbeks worldwide through education, leadership, and international exchange programs.',
                    'uz' => 'Dunyo böylab özbek yoşlarini taʼlim, liderlik va xalqaro almaşinuv dasturlari orqali birlaştiradi.',
                    'ja' => '教育・リーダーシップ・国際交流のプログラムを通じて、世界中の若いウズベキスタン人をつないでいます。',
                ],
            ],
        ],
    ],

    'contact' => [
        'email' => 'hello@uacjp.uz',
        'response' => [
            'en' => 'We typically respond within 2-3 working days.',
            'uz' => 'Odatda 2-3 iş kuni içida javob beramiz.',
            'ja' => '通常、2〜3営業日以内にご返信いたします。',
        ],
        'socials' => [
            ['label' => 'Facebook', 'platform' => 'facebook', 'url' => '#'],
            ['label' => 'Telegram', 'platform' => 'telegram', 'url' => '#'],
        ],
        'regional_contacts' => [
            ['region' => ['en' => 'Kanto', 'uz' => 'Kanto', 'ja' => '関東'], 'email' => 'kanto@uacjp.uz'],
            ['region' => ['en' => 'Kansai', 'uz' => 'Kansai', 'ja' => '関西'], 'email' => 'kansai@uacjp.uz'],
            ['region' => ['en' => 'Chubu', 'uz' => 'Çubu', 'ja' => '中部'], 'email' => 'chubu@uacjp.uz'],
            ['region' => ['en' => 'Kyushu', 'uz' => 'Kyuşu', 'ja' => '九州'], 'email' => 'kyushu@uacjp.uz'],
            ['region' => ['en' => 'Tohoku / Hokkaido', 'uz' => 'Tohoku / Hokkaydo', 'ja' => '東北・北海道'], 'email' => 'north@uacjp.uz'],
        ],
    ],

    'faqs' => [
        ['question' => ['en' => 'Who can join UAC Japan?', 'uz' => 'UAC Japanga kim aʼzo bölişi mumkin?', 'ja' => 'UAC Japanには誰が参加できますか？'], 'answer' => ['en' => 'Uzbek students, researchers, alumni, and academic partners based in or connected to Japan are welcome to apply.', 'uz' => 'Yaponiyada joylaşgan yoki Yaponiya bilan boğliq özbek talabalari, tadqiqotçilari, bitiruvçilari va ilmiy hamkorlari ariza topşirişi mumkin.', 'ja' => '日本在住または日本と関わりのあるウズベキスタン人学生・研究者・卒業生・学術パートナーの方はどなたでもご応募いただけます。']],
        ['question' => ['en' => 'Do I need to belong to a specific university?', 'uz' => 'Muayyan universitetga tegişli bölişim kerakmi?', 'ja' => '特定の大学に所属している必要がありますか？'], 'answer' => ['en' => 'No. UAC Japan is open to members from universities, research institutes, and relevant academic organizations across Japan.', 'uz' => 'Yöq. UAC Japan Yaponiya böylab universitetlar, tadqiqot institutlari va tegişli ilmiy taşkilotlar aʼzolari uçun oçiq.', 'ja' => 'いいえ。UAC Japanは日本各地の大学、研究機関、関連する学術団体のメンバーに開かれています。']],
        ['question' => ['en' => 'Can partner organizations collaborate without individual membership?', 'uz' => 'Hamkor taşkilotlar individual aʼzoliksiz hamkorlik qila oladimi?', 'ja' => 'パートナー団体は個人会員登録なしで協力できますか？'], 'answer' => ['en' => 'Yes. Institutions and organizations can engage through partnership, event sponsorship, or collaborative academic programming.', 'uz' => 'Ha. Muassasalar va taşkilotlar hamkorlik, tadbir homiyligi yoki qöşma ilmiy dasturlar orqali iştirok etişi mumkin.', 'ja' => 'はい。機関や団体は、パートナーシップ、イベントスポンサーシップ、共同学術プログラムを通じて関わることができます。']],
        ['question' => ['en' => 'Are all activities in-person?', 'uz' => 'Barça tadbirlar yuzma-yuz ötkaziladimi?', 'ja' => 'すべての活動は対面で行われますか？'], 'answer' => ['en' => 'No. Many activities are hybrid or fully online so members outside major cities can still participate consistently.', 'uz' => 'Yöq. Köplab tadbirlar aralaş yoki töliq onlayn tarzda ötkaziladi, şunda yirik şaharlardan taşqaridagi aʼzolar ham muntazam iştirok etişi mumkin.', 'ja' => 'いいえ。多くの活動はハイブリッドまたは完全オンラインで行われ、主要都市以外のメンバーも継続的に参加できるようになっています。']],
    ],

    'join' => [
        'eligibility' => [
            ['en' => 'Current undergraduate, graduate, and doctoral students', 'uz' => 'Hozirgi bakalavr, magistratura va doktorantura talabalari', 'ja' => '現役の学部生・大学院生・博士課程学生'],
            ['en' => 'Researchers, postdoctoral fellows, and visiting scholars', 'uz' => 'Tadqiqotçilar, postdoktorantlar va mehmon olimlar', 'ja' => '研究者、博士研究員、客員研究者'],
            ['en' => 'Alumni of Japanese academic institutions', 'uz' => 'Yaponiya ilmiy muassasalari bitiruvçilari', 'ja' => '日本の学術機関の卒業生'],
            ['en' => 'Organizations and partners aligned with the UAC mission', 'uz' => 'UAC missiyasiga mos taşkilotlar va hamkorlar', 'ja' => 'UACの理念に賛同する団体・パートナー'],
        ],
        'benefits' => [
            ['en' => 'Access to regional and national academic community events', 'uz' => 'Mintaqaviy va milliy ilmiy hamjamiyat tadbirlariga kiriş imkoniyati', 'ja' => '地域および全国の学術コミュニティイベントへの参加権'],
            ['en' => 'Mentorship, peer exchange, and collaboration opportunities', 'uz' => 'Murabbiylik, özaro almaşinuv va hamkorlik imkoniyatlari', 'ja' => 'メンタリング、ピア交流、協力の機会'],
            ['en' => 'Visibility for research, publications, and professional milestones', 'uz' => 'Tadqiqot, naşrlar va professional yutuqlar uçun köriniş', 'ja' => '研究・論文発表・キャリアの節目の可視化'],
            ['en' => 'A trusted network for navigating academic life in Japan', 'uz' => 'Yaponiyada ilmiy hayotni yölga qöyiş uçun işonçli tarmoq', 'ja' => '日本での学術生活を支える信頼できるネットワーク'],
        ],
        'types' => [
            ['name' => ['en' => 'Student', 'uz' => 'Talaba', 'ja' => '学生'], 'description' => ['en' => 'For undergraduate, master’s, and doctoral students seeking community and guidance.', 'uz' => 'Hamjamiyat va yöriqnoma izlayotgan bakalavr, magistratura va doktorantura talabalari uçun.', 'ja' => 'コミュニティと指導を求める学部生・修士課程・博士課程の学生向け。']],
            ['name' => ['en' => 'Researcher', 'uz' => 'Tadqiqotçi', 'ja' => '研究者'], 'description' => ['en' => 'For postdoctoral fellows, faculty, and professional researchers engaged in academic work.', 'uz' => 'Ilmiy faoliyat bilan şuğullanuvçi postdoktorantlar, professor-öqituvçilar va professional tadqiqotçilar uçun.', 'ja' => '学術活動に従事する博士研究員、教員、専門研究者向け。']],
            ['name' => ['en' => 'Alumni', 'uz' => 'Bitiruvçilar', 'ja' => '卒業生'], 'description' => ['en' => 'For graduates who want to stay connected, mentor others, and contribute to the network.', 'uz' => 'Aloqada qolişni, boşqalarga murabbiylik qilişni va tarmoqqa hissa qöşişni istagan bitiruvçilar uçun.', 'ja' => 'つながりを維持し、後進を指導し、ネットワークに貢献したい卒業生向け。']],
            ['name' => ['en' => 'Partner', 'uz' => 'Hamkor', 'ja' => 'パートナー'], 'description' => ['en' => 'For institutions, organizations, and sponsors interested in academic cooperation.', 'uz' => 'Ilmiy hamkorlikka qiziqqan muassasalar, taşkilotlar va homiylar uçun.', 'ja' => '学術協力に関心のある機関、団体、スポンサー向け。']],
        ],
    ],

    // Seed source for `php artisan static:seed`; manage events in the admin panel afterwards.
    'events' => [
        [
            'title' => ['en' => 'First Meeting of the Year', 'uz' => 'Bu yil hisobidan birinçi uçraşuv', 'ja' => '今年最初の例会'],
            'date' => '2024-05-27',
            'location' => [
                'en' => 'Tokyo University of Foreign Studies (TUFS), Tokyo',
                'uz' => 'Tokio xorijiy tillar universiteti (TUFS), Tokio',
                'ja' => '東京外国語大学（TUFS）、東京',
            ],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/news/2024-05-27-tufs-meeting.webp',
            'images' => [],
        ],
        [
            'title' => [
                'en' => 'Kanto: Final Meeting of the Year',
                'uz' => 'Kantoda yil hisobidagi oxirgi uçraşuv',
                'ja' => '関東：今年度最後の例会',
            ],
            'date' => '2024-11-30',
            'location' => [
                'en' => 'Tokyo University of Foreign Studies (TUFS), Tokyo',
                'uz' => 'Tokio xorijiy tillar universiteti (TUFS), Tokio',
                'ja' => '東京外国語大学（TUFS）、東京',
            ],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2024-11-30-tufs-kanto-group.webp',
            'images' => [],
        ],
        [
            'title' => [
                'en' => 'Yokohama: First Meeting of the Year',
                'uz' => 'Yokohamada yil hisobidagi birinçi uçraşuv',
                'ja' => '横浜：今年最初の例会',
            ],
            'date' => '2025-01-25',
            'location' => [
                'en' => 'Yokohama National University (YNU), Yokohama',
                'uz' => 'Yokohama milliy universiteti (YNU), Yokohama',
                'ja' => '横浜国立大学（YNU）、横浜',
            ],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2025-01-ynu-kanto-group.webp',
            'images' => [],
        ],
        [
            'title' => [
                'en' => 'Sixth Meeting at the University of Tsukuba',
                'uz' => 'Tsukuba universitetida 6-uçraşuv',
                'ja' => '筑波大学での第6回例会',
            ],
            'date' => '2025-04-12',
            'location' => [
                'en' => 'University of Tsukuba, Ibaraki',
                'uz' => 'Tsukuba universiteti, Ibaraki',
                'ja' => '筑波大学、茨城',
            ],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2025-04-12-tsukuba-group.webp',
            'images' => [],
        ],
        [
            'title' => [
                'en' => 'Meeting at the Embassy of Uzbekistan in Japan',
                'uz' => 'Yaponiyadagi Özbekiston elçixonasida uçraşuv',
                'ja' => '在日ウズベキスタン大使館での例会',
            ],
            'date' => '2026-04-11',
            'location' => [
                'en' => 'Embassy of the Republic of Uzbekistan in Japan, Tokyo',
                'uz' => 'Özbekiston Respublikasining Yaponiyadagi elçixonasi, Tokio',
                'ja' => '在日ウズベキスタン共和国大使館、東京',
            ],
            'type' => ['en' => 'Meeting', 'uz' => 'Uçraşuv', 'ja' => '例会'],
            'thumbnail' => 'images/events/2026-04-11-embassy-group.webp',
            'images' => [],
        ],
        ['title' => ['en' => 'Annual Scholar Symposium', 'uz' => 'Yillik olimlar simpoziumi', 'ja' => '年次学術シンポジウム'], 'date' => '2026-11-15', 'location' => ['en' => 'Tokyo', 'uz' => 'Tokio', 'ja' => '東京'], 'type' => ['en' => 'Symposium', 'uz' => 'Simpozium', 'ja' => 'シンポジウム']],
        ['title' => ['en' => 'Regional Chapter Meetup', 'uz' => 'Mintaqaviy uçraşuv', 'ja' => '地域支部ミートアップ'], 'date' => '2026-12-05', 'location' => ['en' => 'Osaka', 'uz' => 'Osaka', 'ja' => '大阪'], 'type' => ['en' => 'Meetup', 'uz' => 'Uçraşuv', 'ja' => 'ミートアップ']],
        ['title' => ['en' => 'Research Writing Workshop', 'uz' => 'Tadqiqot yoziş ustaxonasi', 'ja' => '研究執筆ワークショップ'], 'date' => '2027-01-20', 'location' => ['en' => 'Online', 'uz' => 'Onlayn', 'ja' => 'オンライン'], 'type' => ['en' => 'Workshop', 'uz' => 'Ustaxona', 'ja' => 'ワークショップ']],
        ['title' => ['en' => 'Career & Mentorship Forum', 'uz' => 'Karyera va murabbiylik forumi', 'ja' => 'キャリア＆メンタリングフォーラム'], 'date' => '2027-02-10', 'location' => ['en' => 'Kyoto', 'uz' => 'Kyoto', 'ja' => '京都'], 'type' => ['en' => 'Forum', 'uz' => 'Forum', 'ja' => 'フォーラム']],
    ],

    'event_gallery' => [
        'images/events/2026-04-11-embassy-session.webp',
        'images/events/2026-04-11-embassy-discussion.webp',
        'images/events/2026-04-11-embassy-book.webp',
        'images/events/2026-04-11-embassy-tea.webp',
        'images/events/2025-04-12-tsukuba-campus.webp',
        'images/events/2025-04-12-tsukuba-hall.webp',
        'images/events/2025-04-12-tsukuba-whiteboard.webp',
        'images/events/2025-01-ynu-kanto-talk.webp',
        'images/events/2024-11-30-tufs-kanto-hall.webp',
        'images/events/2024-11-30-tufs-kanto-discussion.webp',
    ],
];
