<?php

/* SiteBundle:Advert:add.html.twig */
class __TwigTemplate_5264151fe96d029725ce657596a00436c6767c66a780333c5bf78c6de6482cf2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("SiteBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'Site_body' => array($this, 'block_Site_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SiteBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "  Ajouter une annonce - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 7
    public function block_Site_body($context, array $blocks = array())
    {
        // line 8
        echo "
  <h2>Modifier une annonce</h2>

  ";
        // line 11
        echo twig_include($this->env, $context, "SiteBundle:Advert:form.html.twig");
        echo "

  <p>
    Vous ajoutez une annonce.
  </p>

  <p>
    <a href=\"";
        // line 18
        echo $this->env->getExtension('routing')->getPath("Site_home");
        echo "\" class=\"btn btn-default\">
      <i class=\"glyphicon glyphicon-chevron-left\"></i>
      Retour à l'accueil
    </a>
  </p>

";
    }

    public function getTemplateName()
    {
        return "SiteBundle:Advert:add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 18,  55 => 11,  50 => 8,  47 => 7,  40 => 4,  37 => 3,  11 => 1,);
    }
}
