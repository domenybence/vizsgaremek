<?php
include_once "../php_functions/php_functions.php";
if (session_status() === PHP_SESSION_NONE) {
    startSession();
}

// Redirect if user is not admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CodeOverflow adminisztrációs felület">
    <title>Admin Panel - CodeOverflow</title>
    <link rel="stylesheet" href="/src/web/css/admin.css">
    <link rel="stylesheet" href="/src/web/css/loader.css">
    <link rel="stylesheet" href="/src/web/css/navbar.css">
    <link rel="icon" type="image/x-icon" href="/src/web/icon.png">
    <script src="/src/web/js/navbar.js" defer></script>
    <script src="/src/web/js/admin.js" defer></script>
</head>

<body class="bg-dark">
    <script src="/src/web/js/gsap-public/minified/gsap.min.js"></script>

    <div class="page-cover"></div>

    <?php include "navbar.php"; ?>

    <div class="admin-container">
        <div class="admin-header">
            <h1>Adminisztrációs Panel</h1>
        </div>

        <div class="admin-main">
            <div class="admin-sidebar">
                <div class="sidebar-header">
                    <h3>Kezelőfelület</h3>
                </div>
                <ul class="sidebar-menu">
                    <li class="sidebar-item active" data-tab="users">
                        <i class="icon users-icon"></i>
                        <span>Felhasználók</span>
                    </li>
                    <li class="sidebar-item" data-tab="permissions">
                        <i class="icon permissions-icon"></i>
                        <span>Jogosultságok</span>
                    </li>
                    <li class="sidebar-item" data-tab="content">
                        <i class="icon content-icon"></i>
                        <span>Kategóriák</span>
                    </li>
                    <li class="sidebar-item" data-tab="settings">
                        <i class="icon settings-icon"></i>
                        <span>Beállítások</span>
                    </li>
                </ul>
            </div>

            <div class="admin-content">
                <div class="tab-content active" id="users-tab">
                    <div class="content-header">
                        <h2>Felhasználók kezelése</h2>
                        <div class="content-actions">
                            <div class="search-box">
                                <input type="text" id="user-search" placeholder="Felhasználó keresése...">
                                <button id="search-button">Keresés</button>
                            </div>
                        </div>
                    </div>

                    <div class="users-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Azonosító</th>
                                    <th>Felhasználónév</th>
                                    <th>Email</th>
                                    <th>Jogosultság</th>
                                    <th>Pontok</th>
                                    <th>Regisztráció dátuma</th>
                                    <th>Műveletek</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                <tr>
                                    <td colspan="7" class="table-loading">Felhasználók betöltése...</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <button class="pagination-btn" id="prev-page">&laquo; Előző</button>
                            <div id="page-numbers" class="page-numbers">
                            </div>
                            <button class="pagination-btn" id="next-page">Következő &raquo;</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="permissions-tab">
                    <div class="content-header">
                        <h2>Jogosultságok kezelése</h2>
                    </div>
                    <div class="permissions-content">
                        <p>Ezen a felületen beállíthatja a különböző felhasználói jogosultságokat.</p>
                        <div class="placeholder-box">
                            <p>Jogosultsági beállítások</p>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="content-tab">
                    <div class="content-header">
                        <h2>Kategóriák kezelése</h2>
                        <div class="content-actions">
                            <div class="search-box">
                                <button id="new-category-button" class="primary-btn" onclick="openNewCategoryEditModal()">Új kategória</button>
                            </div>
                        </div>
                    </div>
                    <div class="categories-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Azonosító</th>
                                    <th>Név</th>
                                    <th>Compiler azonosító</th>
                                    <th>Kép</th>
                                    <th>Műveletek</th>
                                </tr>
                            </thead>
                            <tbody id="categories-table-body">
                                <tr>
                                    <td colspan="4" class="table-loading">Kategóriák betöltése...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="tab-content" id="settings-tab">
                <div class="content-header">
                    <h2>Rendszer beállítások</h2>
                </div>
                <div class="settings-content">
                    <p>Itt módosíthatja a rendszer különböző beállításait.</p>
                    <div class="placeholder-box">
                        <p>Rendszerbeállítások</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="user-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Felhasználó szerkesztése</h3>
                <span class="close" onclick="closeModalWithAnimation('user-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="user-form">
                    <input type="hidden" id="user-id">

                    <div class="form-group">
                        <label for="username">Felhasználónév</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email cím</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Jogosultság</label>
                        <select id="role" name="role">
                            <option value="user">Felhasználó</option>
                            <option value="moderator">Moderátor</option>
                            <option value="admin">Adminisztrátor</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="points">Pontok</label>
                        <input type="number" id="points" name="points" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="password">Új jelszó (üresen hagyható)</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <div class="form-actions">
                        <button type="button" id="cancel-btn" class="secondary-btn" onclick="closeModalWithAnimation('user-modal')">Mégse</button>
                        <button type="submit" id="save-btn" class="primary-btn">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="confirm-modal" class="modal">
        <div class="modal-content confirm-modal-content">
            <div class="modal-header">
                <h3>Megerősítés</h3>
                <span class="close" onclick="closeModalWithAnimation('confirm-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Biztosan törölni szeretné ezt a felhasználót?</p>
                <div class="form-actions">
                    <button type="button" id="cancel-delete-btn" class="secondary-btn" onclick="closeModalWithAnimation('confirm-modal')">Mégse</button>
                    <button type="button" id="confirm-delete-btn" class="danger-btn">Törlés</button>
                </div>
            </div>
        </div>
    </div>

    <div id="category-modal" class="modal">
        <div class="modal-content">      
            <div class="modal-header">
                <h3 id="modal-title">Kategória szerkesztése</h2>
                <span class="close" onclick="closeModalWithAnimation('category-modal')">&times;</span>
            </div>
            <div class="modal-body">
            <form id="category-form">
                <input type="hidden" id="category-id">
                <div class="form-group">
                    <label for="category-name">Név</label>
                    <input type="text" id="category-name" name="category-name" required>
                </div>
                <div class="form-group">
                    <label for="category-compiler">Compiler azonosító:</label>
                    <input type="text" id="category-compiler" required>
                </div>
                <div class="form-group">
                <label for="category-image">Kép URL:</label>
                <input type="text" id="category-image">
                </div>
                <div class="form-actions">
                <button type="button" id="cancel-btn" class="secondary-btn" onclick="closeModalWithAnimation('category-modal')">Mégse</button>
                <button type="submit" id="save-category-btn" class="primary-btn">Mentés</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div id="confirm-category-modal" class="modal">
        <div class="modal-content confirm-modal-content">
            <div class="modal-header">
                <h3>Megerősítés</h3>
                <span class="close" onclick="closeModalWithAnimation('confirm-category-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <h2>Biztosan törölni szeretné ezt a kategóriát?</h2>
                <div class="form-actions">
                    <button type="button" id="cancel-category-delete-btn" class="secondary-btn" onclick="closeModalWithAnimation('confirm-category-modal')">Mégse</button>
                    <button type="button" id="confirm-category-delete-btn" onclick="closeModalWithAnimation('confirm-category-modal')" class="danger-btn">Törlés</button>
                </div>
            </div>
        </div>
    </div>

    <div id="new-category-modal" class="modal">
        <div class="modal-content">      
            <div class="modal-header">
                <h3 id="modal-title">Új kategória</h2>
                <span class="close" onclick="closeModalWithAnimation('category-modal')">&times;</span>
            </div>
            <div class="modal-body">
            <form id="new-category-form">
            
                <div class="form-group">
                    <label for="category-name">Név</label>
                    <input type="text" id="new-category-name" name="category-name" required>
                </div>
                <div class="form-group">
                    <label for="category-compiler">Compiler azonosító:</label>
                    <input type="text" id="new-category-compiler" required>
                </div>
                <div class="form-group">
                <label for="category-image">Kép URL:</label>
                <input type="text" id="new-category-image">
                </div>
                <div class="form-actions">
                <button type="button" id="cancel-btn" class="secondary-btn" onclick="closeModalWithAnimation('new-category-modal')">Mégse</button>
                <button type="submit" id="save-new-category-btn" class="primary-btn">Mentés</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div id="toast-message" class="toast-message"></div>

    <script src="/src/web/js/loader.js"></script>
</body>

</html>