<?php
session_start();

function redirect($path) {
    header('Location: ' . $path);
    exit;
}

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function isAdmin() {
    return !empty($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '';

        if (strpos($currentUrl, '/admin/') !== false) {
            redirect('../auth/login.php');
        } else {
            redirect('auth/login.php');
        }
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '';

        if (strpos($currentUrl, '/admin/') !== false) {
            redirect('../dashboard.php');
        } else {
            redirect('dashboard.php');
        }
    }
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
