<?php require_once 'init.php'; ?>
<?php require "haut_page.php"; ?>

<!-- Section de Confirmation -->
<section class="flex items-center justify-center bg-neutral-100" style="height: calc(100vh - 80px);">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-serif font-bold text-neutral-900 mb-4">Inscription réussie</h1>
        <p class="text-neutral-700 mb-6">
            Votre inscription est terminée. Vous pouvez maintenant vous connecter avec votre compte.
        </p>
        <a href="collection.php"
            class="inline-block px-6 py-3 border border-harvardRed text-harvardRed rounded-md hover:bg-harvardRed hover:text-white transition font-semibold">
            Acceder a la collection
        </a>
    </div>
</section>

<?php require "bas_page.php"; ?>
