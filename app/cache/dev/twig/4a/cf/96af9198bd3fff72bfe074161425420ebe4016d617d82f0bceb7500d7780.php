<?php

/* UserInformationUserBundle::base.html.twig */
class __TwigTemplate_4acf96af9198bd3fff72bfe074161425420ebe4016d617d82f0bceb7500d7780 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'blog_title' => array($this, 'block_blog_title'),
            'navigation' => array($this, 'block_navigation'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- app/Resources/views/base.html.twig -->
<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">
        <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo " - symblog</title>
        <!--[if lt IE 9]>
            <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
            <script src=\"http://getbootstrap.com/assets/js/ie8-responsive-file-warning.js\"></script>
        <![endif]-->
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        ";
        // line 16
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 22
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
          <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>
        <div class=\"site-wrapper\">
            <div class=\"site-wrapper-inner\">
                <div class=\"cover-container\">
                    <div class=\"masthead clearfix\">
                        <div class=\"inner\">
                          <h3 class=\"masthead-brand\">";
        // line 35
        $this->displayBlock('blog_title', $context, $blocks);
        echo "</h3>
                          ";
        // line 36
        $this->displayBlock('navigation', $context, $blocks);
        // line 43
        echo "                        </div>
                    </div>

                    <div class=\"inner cover\">
                        ";
        // line 47
        $this->displayBlock('body', $context, $blocks);
        // line 48
        echo "                    </div>

                    <div class=\"mastfoot\">
                        ";
        // line 51
        $this->displayBlock('footer', $context, $blocks);
        // line 56
        echo "                    </div>
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        ";
        // line 64
        $this->displayBlock('javascripts', $context, $blocks);
        // line 72
        echo "    </body>
</html>";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        echo "symblog";
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 17
        echo "            <link href='http://fonts.googleapis.com/css?family=Irish+Grover' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=La+Belle+Aurore' rel='stylesheet' type='text/css'>
            <link href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
            <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/cover.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        ";
    }

    // line 35
    public function block_blog_title($context, array $blocks = array())
    {
        echo "Cover";
    }

    // line 36
    public function block_navigation($context, array $blocks = array())
    {
        // line 37
        echo "                          <ul class=\"nav masthead-nav\">
                            <li class=\"active\"><a href=\"#\">Home</a></li>
                            <li><a href=\"#\">Features</a></li>
                            <li><a href=\"#\">Contact</a></li>
                          </ul>
                          ";
    }

    // line 47
    public function block_body($context, array $blocks = array())
    {
    }

    // line 51
    public function block_footer($context, array $blocks = array())
    {
        // line 52
        echo "                        <div class=\"inner\">
                          <p>Cover template for <a href=\"http://getbootstrap.com\">Bootstrap</a>, by <a href=\"https://twitter.com/mdo\">@mdo</a>.</p>
                        </div>
                        ";
    }

    // line 64
    public function block_javascripts($context, array $blocks = array())
    {
        // line 65
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/userinformationuser/js/ie-emulation-modes-warning.js"), "html", null, true);
        echo "\"></script>
            <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
            <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/userinformationuser/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"{ asset('bundles/userinformationuser/js/docs.min.js') }}\"></script>
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src=\"{ asset('bundles/userinformationuser/js/ie10-viewport-bug-workaround.js') }}\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "UserInformationUserBundle::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 52,  126 => 35,  84 => 51,  77 => 47,  65 => 35,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 86,  268 => 85,  264 => 84,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 70,  214 => 69,  177 => 65,  169 => 60,  140 => 55,  132 => 36,  128 => 49,  107 => 36,  61 => 13,  273 => 96,  269 => 94,  254 => 92,  243 => 88,  240 => 86,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 77,  219 => 76,  217 => 75,  208 => 68,  204 => 72,  179 => 69,  159 => 64,  143 => 56,  135 => 37,  119 => 42,  102 => 32,  71 => 43,  67 => 15,  63 => 15,  59 => 14,  38 => 6,  94 => 28,  89 => 20,  85 => 25,  75 => 17,  68 => 14,  56 => 9,  87 => 25,  21 => 2,  26 => 1,  93 => 28,  88 => 6,  78 => 21,  46 => 16,  27 => 4,  44 => 12,  31 => 5,  28 => 3,  201 => 92,  196 => 90,  183 => 82,  171 => 61,  166 => 71,  163 => 62,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 54,  136 => 56,  121 => 46,  117 => 44,  105 => 40,  91 => 27,  62 => 23,  49 => 19,  24 => 4,  25 => 3,  19 => 1,  79 => 48,  72 => 16,  69 => 36,  47 => 9,  40 => 8,  37 => 10,  22 => 2,  246 => 90,  157 => 56,  145 => 46,  139 => 45,  131 => 52,  123 => 47,  120 => 20,  115 => 43,  111 => 37,  108 => 36,  101 => 32,  98 => 72,  96 => 64,  83 => 25,  74 => 14,  66 => 15,  55 => 15,  52 => 21,  50 => 10,  43 => 8,  41 => 7,  35 => 5,  32 => 4,  29 => 3,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 84,  182 => 66,  176 => 64,  173 => 65,  168 => 67,  164 => 59,  162 => 65,  154 => 58,  149 => 51,  147 => 58,  144 => 47,  141 => 48,  133 => 55,  130 => 41,  125 => 44,  122 => 43,  116 => 19,  112 => 17,  109 => 16,  106 => 36,  103 => 10,  99 => 31,  95 => 28,  92 => 21,  86 => 56,  82 => 22,  80 => 19,  73 => 19,  64 => 17,  60 => 6,  57 => 11,  54 => 10,  51 => 14,  48 => 22,  45 => 17,  42 => 7,  39 => 9,  36 => 5,  33 => 4,  30 => 7,);
    }
}
