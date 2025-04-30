<?php require "haut_page.php"; ?>

    <!-- Hero Section -->
    <section class="relative bg-neutral-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 py-24 text-center">
            <h2 class="text-5xl font-serif font-bold mb-6">Explorez des siècles d'art et d'histoire</h2>
            <p class="text-lg text-neutral-700 mb-8 max-w-2xl mx-auto">
                Le Harvard Art Museum conserve une collection inestimable ouverte à tous. Découvrez nos expositions permanentes et temporaires.
            </p>
            <a href="#" class="inline-block px-8 py-4 bg-harvardRed text-white font-semibold rounded-full hover:bg-red-800 transition">
                Voir les expositions
            </a>
        </div>
    </section>

    <!-- Featured Collection Section -->
    <section class="max-w-7xl mx-auto px-8 py-20">
        <h3 class="text-3xl font-serif font-bold mb-12">Collections en vedette</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white border border-neutral-200 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/600x400/?art,painting" alt="Collection 1" class="w-full h-60 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-serif font-bold mb-2">Peintures Européennes</h4>
                    <p class="text-neutral-700 text-sm">Une sélection unique d'œuvres du Moyen Âge à la Renaissance.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white border border-neutral-200 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/600x400/?museum,sculpture" alt="Collection 2" class="w-full h-60 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-serif font-bold mb-2">Sculptures Classiques</h4>
                    <p class="text-neutral-700 text-sm">Découvrez les chefs-d'œuvre gréco-romains exposés avec soin.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white border border-neutral-200 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/600x400/?museum,photography" alt="Collection 3" class="w-full h-60 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-serif font-bold mb-2">Photographies Modernes</h4>
                    <p class="text-neutral-700 text-sm">Voyagez dans le temps grâce à des clichés du XXe siècle.</p>
                </div>
            </div>
        </div>
    </section>
    <?php require "bas_page.php"; ?>
