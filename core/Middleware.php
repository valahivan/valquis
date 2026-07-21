<?php 

namespace ValahIvanMaulana\Core;

interface Middleware {
    public static function handle(string $key, string $page) : void;
}