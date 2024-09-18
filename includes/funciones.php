<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function sanitizar($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool{
    return ($actual !== $proximo);
}

function isSession() : void {
    if(!isset($_SESSION)) {
        session_start();
    }
}
//Función que revisa que el User esté autenticado
function isAuth(): void{
    if(!isset($_SESSION['login'])){
        header('location: /');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}