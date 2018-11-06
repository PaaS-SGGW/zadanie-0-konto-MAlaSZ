<?php
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 17.06.17
 * Time: 11:04
 */

class Router {
    private static $ApplicationPath;
    public static $Content;
    public static $Controllers;
    public static $Models;
    public static $Views;
    public static $Config;
    public static $Scripts;

    public static $Media;

    public static function Init()
    {
        self::$ApplicationPath = __DIR__;

        self::$Content = array (
            "Front" => self::$ApplicationPath . '/public/content.php',
            "Admin" => self::$ApplicationPath . '/public/content.php'
        );

        self::$Controllers = array(
                "ConstantPost" => array(
                    "Create" => self::$ApplicationPath . '/application/controllers/constantPost/Create.php',
                    "Read" => self::$ApplicationPath . '/application/controllers/constantPost/Read.php',
                    "Update" => self::$ApplicationPath . '/application/controllers/constantPost/Update.php',
                    "Delete" => self::$ApplicationPath . '/application/controllers/constantPost/Delete.php',
                ),
                "Post" => array(
                    "Create" => self::$ApplicationPath . '/application/controllers/post/Create.php',
                    "Delete" => self::$ApplicationPath . '/application/controllers/post/Delete.php',
                    "List" => self::$ApplicationPath . '/application/controllers/post/List.php',
                    "Read" => self::$ApplicationPath . '/application/controllers/post/Read.php',
                    "Update" => self::$ApplicationPath . '/application/controllers/post/Update.php'
                ),
                "User" => array(
                    "Login" => self::$ApplicationPath . '/application/controllers/user/Login.php',
                    "Logout" => self::$ApplicationPath . '/application/controllers/user/Logout.php',
                    "Read" => self::$ApplicationPath . '/application/controllers/user/Read.php',
                    "Update" => self::$ApplicationPath . '/application/controllers/user/Update.php'
                ),
                "Image" => array (
                    "List" => self::$ApplicationPath . '/application/controllers/image/List.php',
                    "Upload" => self::$ApplicationPath . '/application/controllers/image/Upload.php'
                )
            );

        self::$Models = array(
                "Post" => self::$ApplicationPath . '/application/models/Post.php',
                "ConstantPost" => self::$ApplicationPath . '/application/models/ConstantPost.php',
                "User" => self::$ApplicationPath . '/application/models/User.php',
                "Image" => self::$ApplicationPath . '/application/models/Image.php'
            );

        self::$Views = array(
            "Content" => array(
                "Admin" => array(
                    "AddEntry" => self::$ApplicationPath . '/application/views/content/admin/AddEntry.php',
                    "AddBlogEntry" => self::$ApplicationPath . '/application/views/content/admin/AddBlogEntry.php',
                    "EditEntry" => self::$ApplicationPath . '/application/views/content/admin/EditEntry.php',
                    "EditBlogEntry" => self::$ApplicationPath . '/application/views/content/admin/EditBlogEntry.php',
                    "EntryList" => self::$ApplicationPath . '/application/views/content/admin/EntryList.php',
                    "BlogEntryList" => self::$ApplicationPath . '/application/views/content/admin/BlogEntryList.php',
                    "LoginSite" => self::$ApplicationPath . '/application/views/content/admin/LoginSite.php',
                        "Settings" => self::$ApplicationPath . '/application/views/content/admin/Settings.php',
                        "SettingsBlog" => self::$ApplicationPath . '/application/views/content/admin/SettingsBlog.php',
                    ),
                "Front" => array(
                        "Partials" => array(
                            "Calendar" => self::$ApplicationPath . '/application/views/content/front/partials/calendar.php',
                            "Contact" => self::$ApplicationPath . '/application/views/content/front/partials/contact.php',
                            "EntryShort" => self::$ApplicationPath . '/application/views/content/front/partials/entryshort.php',
                            "Me" => self::$ApplicationPath . '/application/views/content/front/partials/me.php',
                        ),
                        "About" => self::$ApplicationPath . '/application/views/content/front/about.php',
                        "Article" => self::$ApplicationPath . '/application/views/content/front/article.php',
                        "Blog" => self::$ApplicationPath . '/application/views/content/front/blog.php',
                        "Contact" => self::$ApplicationPath . '/application/views/content/front/contact.php',
                        "Home" => self::$ApplicationPath . '/application/views/content/front/home.php',
                    )
                ),
            "Layout" => array(
                "Admin" => array(
                        "Sidebar" => self::$ApplicationPath . '/application/views/layout/admin/sidebar.php',
                        "Error" => self::$ApplicationPath . '/application/views/layout/admin/error.php'
                    ),
                "Front" => array(
                        "Footer" => self::$ApplicationPath . '/application/views/layout/front/footer.php',
                        "Navbar" => self::$ApplicationPath . '/application/views/layout/front/navbar.php',
                        "LangSelector" => self::$ApplicationPath . '/application/views/layout/front/langSelector.php'
                    )
                ),
            "404" => self::$ApplicationPath . "/public/404.html"
            );

        self::$Config = array (
                "Database" => self::$ApplicationPath . '/config/Database/db.php',
                "Language" => self::$ApplicationPath . '/config/I18N/Language.php',
                "Settings" => array (
                    "Read" => self::$ApplicationPath . '/config/Settings/Read.php',
                    "Update" => self::$ApplicationPath . '/config/Settings/Update.php'
                )
            );

        self::$Scripts = array(
                "Calendar" => self::$ApplicationPath. '/scripts/calendar/Calendar.php'
            );
        self::$Media = array(
            "Pictures" => 'images/'
        );

        }
    }

    Router::Init();
//$Router = new Router();

?>