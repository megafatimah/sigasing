<?php

    if(isset($_GET['page'])) {
        $page = $_GET['page'];

        switch($page){
            case '': 
            
            case 'home': 
                file_exists('pages/home.php') ? include 'pages/home.php' : include 'pages/404.php';
                break;
            
            // routing lokasi
            case 'lokasiread':
                file_exists('pages/admin/lokasi/lokasiread.php') ? include 'pages/admin/lokasi/lokasiread.php' : include 'pages/404.php';  
                break;

            case 'lokasicreate':
                file_exists('pages/admin/lokasi/lokasicreate.php') ? include 'pages/admin/lokasi/lokasicreate.php' : include 'pages/404.php';  
                break;

            case 'lokasiupdate':
                file_exists('pages/admin/lokasi/lokasiupdate.php') ? include 'pages/admin/lokasi/lokasiupdate.php' : include 'pages/404.php';  
                break;

            case 'lokasidelete':
                file_exists('pages/admin/lokasi/lokasidelete.php') ? include 'pages/admin/lokasi/lokasidelete.php' : include 'pages/404.php';  
                break;

            // routing jabatan
            case 'jabatanread':
                file_exists('pages/admin/jabatan/jabatanread.php') ? include 'pages/admin/jabatan/jabatanread.php' : include 'pages/404.php';  
                break;

            case 'jabatancreate':
                file_exists('pages/admin/jabatan/jabatancreate.php') ? include 'pages/admin/jabatan/jabatancreate.php' : include 'pages/404.php';  
                break;

            case 'jabatanupdate':
                file_exists('pages/admin/jabatan/jabatanupdate.php') ? include 'pages/admin/jabatan/jabatanupdate.php' : include 'pages/404.php';  
                break;

            case 'jabatandelete':
                file_exists('pages/admin/jabatan/jabatandelete.php') ? include 'pages/admin/jabatan/jabatandelete.php' : include 'pages/404.php';  
                break;

            default:
                include 'pages/404.php';    
        }
    }else{
        include "pages/home.php";
    }
?>