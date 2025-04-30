<?php require_once 'init.php'; ?>
<?php require "haut_page.php"; ?>

<!-- Section d'Inscription -->
<section class="flex items-center justify-center bg-neutral-100" style="height: calc(100vh - 80px);">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-serif font-bold text-neutral-900">Créer un compte</h2>
            <p class="mt-2 text-sm text-neutral-600">
                Remplissez les informations suivantes pour vous inscrire.
            </p>

            <!-- Affichage message d'erreur -->
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='text-red-600 mt-2'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
        </div>

        <form action="traitement_inscription.php" method="POST" class="space-y-6">
            <div class="space-y-4">
                <!-- Champ Prénom -->
                <div>
                    <label for="firstname" class="block text-sm font-medium text-neutral-700 mb-1">Prénom</label>
                    <input type="text" name="firstname" id="firstname" required
                        class="block w-full px-4 py-3 border border-neutral-300 rounded-md placeholder-neutral-400 text-neutral-900 focus:outline-none focus:ring-harvardRed focus:border-harvardRed sm:text-sm"
                        placeholder="Votre prénom">
                </div>

                <!-- Champ Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-700 mb-1">Nom</label>
                    <input type="text" name="name" id="name" required
                        class="block w-full px-4 py-3 border border-neutral-300 rounded-md placeholder-neutral-400 text-neutral-900 focus:outline-none focus:ring-harvardRed focus:border-harvardRed sm:text-sm"
                        placeholder="Votre nom">
                </div>

                <!-- Champ Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-1">Adresse Email</label>
                    <input type="email" name="email" id="email" required
                        class="block w-full px-4 py-3 border border-neutral-300 rounded-md placeholder-neutral-400 text-neutral-900 focus:outline-none focus:ring-harvardRed focus:border-harvardRed sm:text-sm"
                        placeholder="exemple@email.com">
                </div>

                <!-- Champ Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="block w-full px-4 py-3 border border-neutral-300 rounded-md placeholder-neutral-400 text-neutral-900 focus:outline-none focus:ring-harvardRed focus:border-harvardRed sm:text-sm"
                        placeholder="Votre mot de passe">
                </div>

                <!-- Champ Confirmer le mot de passe -->
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-neutral-700 mb-1">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" id="confirm_password" required
                        class="block w-full px-4 py-3 border border-neutral-300 rounded-md placeholder-neutral-400 text-neutral-900 focus:outline-none focus:ring-harvardRed focus:border-harvardRed sm:text-sm"
                        placeholder="Confirmez votre mot de passe">
                </div>
            </div>

            <!-- Bouton Soumettre -->
            <div class="space-y-4">
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-white bg-harvardRed hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-harvardRed font-semibold">
                    S'inscrire
                </button>

                <!-- Lien connexion -->
                <div class="text-center">
                    <a href="connexion.php"
                        class="w-full flex justify-center py-3 px-4 border border-harvardRed text-harvardRed rounded-md hover:bg-harvardRed hover:text-white transition font-semibold">
                        Déjà un compte ? Connectez-vous
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>

<?php require "bas_page.php"; ?>
