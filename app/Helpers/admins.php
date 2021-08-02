<?php


function adminsMiddleware(){
    return ['auth:admins', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'];
}