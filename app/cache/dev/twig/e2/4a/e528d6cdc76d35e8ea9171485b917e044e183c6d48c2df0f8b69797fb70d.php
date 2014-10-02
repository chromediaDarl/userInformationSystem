<?php

/* UserInformationUserBundle:Secured:login.html.twig */
class __TwigTemplate_e24ae528d6cdc76d35e8ea9171485b917e044e183c6d48c2df0f8b69797fb70d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("UserInformationUserBundle::loginlayout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "UserInformationUserBundle::loginlayout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"container\">

      <form class=\"form-signin\" role=\"form\">
        <h2 class=\"form-signin-heading\">Please sign in</h2>
        <input type=\"email\" class=\"form-control\" placeholder=\"Email address\" required autofocus>
        <input type=\"password\" class=\"form-control\" placeholder=\"Password\" required>
        <label class=\"checkbox\">
          <input type=\"checkbox\" value=\"remember-me\"> Remember me
        </label>
        <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Sign in</button>
      </form>

      ";
        // line 17
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 18
            echo "          <div>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message"), "html", null, true);
            echo "</div>
      ";
        }
        // line 20
        echo "
      <form class=\"form-signin\" role=\"form\" action=\"";
        // line 21
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\">
          <h2 class=\"form-signin-heading\">Please sign in</h2>
          <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["last_email"]) ? $context["last_email"] : $this->getContext($context, "last_email")), "html", null, true);
        echo "\" placeholder=\"Email address\" required autofocus>
          <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" placeholder=\"Password\" required>

          ";
        // line 31
        echo "          <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Sign in</button>
      </form>
    </div> <!-- /container -->
";
    }

    public function getTemplateName()
    {
        return "UserInformationUserBundle:Secured:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 6,  126 => 34,  118 => 32,  114 => 17,  212 => 71,  186 => 69,  181 => 68,  178 => 67,  161 => 41,  155 => 40,  104 => 67,  84 => 50,  124 => 40,  23 => 1,  53 => 20,  20 => 1,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 86,  268 => 85,  264 => 84,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 70,  214 => 69,  177 => 65,  169 => 60,  140 => 55,  132 => 51,  128 => 49,  107 => 36,  61 => 23,  273 => 96,  269 => 94,  254 => 92,  243 => 88,  240 => 86,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 77,  219 => 76,  217 => 75,  208 => 68,  204 => 72,  179 => 69,  159 => 61,  143 => 56,  135 => 53,  119 => 42,  102 => 32,  71 => 19,  67 => 31,  63 => 15,  59 => 14,  38 => 11,  94 => 15,  89 => 14,  85 => 25,  75 => 48,  68 => 14,  56 => 21,  87 => 25,  21 => 2,  26 => 6,  93 => 28,  88 => 15,  78 => 41,  46 => 7,  27 => 4,  44 => 12,  31 => 5,  28 => 4,  201 => 92,  196 => 90,  183 => 82,  171 => 61,  166 => 71,  163 => 62,  158 => 67,  156 => 66,  151 => 17,  142 => 59,  138 => 54,  136 => 56,  121 => 46,  117 => 13,  105 => 40,  91 => 27,  62 => 23,  49 => 19,  24 => 4,  25 => 1,  19 => 1,  79 => 21,  72 => 16,  69 => 38,  47 => 18,  40 => 11,  37 => 10,  22 => 2,  246 => 90,  157 => 37,  145 => 46,  139 => 45,  131 => 35,  123 => 33,  120 => 14,  115 => 43,  111 => 11,  108 => 36,  101 => 32,  98 => 31,  96 => 31,  83 => 14,  74 => 11,  66 => 33,  55 => 15,  52 => 21,  50 => 21,  43 => 13,  41 => 7,  35 => 9,  32 => 4,  29 => 3,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 84,  182 => 66,  176 => 64,  173 => 50,  168 => 72,  164 => 42,  162 => 57,  154 => 58,  149 => 51,  147 => 58,  144 => 49,  141 => 48,  133 => 42,  130 => 41,  125 => 15,  122 => 43,  116 => 41,  112 => 42,  109 => 34,  106 => 72,  103 => 32,  99 => 31,  95 => 28,  92 => 21,  86 => 51,  82 => 22,  80 => 13,  73 => 41,  64 => 32,  60 => 6,  57 => 11,  54 => 10,  51 => 14,  48 => 18,  45 => 17,  42 => 18,  39 => 9,  36 => 5,  33 => 9,  30 => 7,);
    }
}
