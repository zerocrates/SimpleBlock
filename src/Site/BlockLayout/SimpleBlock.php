<?php
namespace SimpleBlock\Site\BlockLayout;

use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Zend\View\Renderer\PhpRenderer;

/**
 * The block layout class encapsulates everything about your custom block.
 *
 * Everything the user sees about your block, both on the admin and public
 * sides, gets defined here.
 */
class SimpleBlock extends AbstractBlockLayout
{
    /**
     * getLabel() is where you define the label users will see when selecting
     * your block.
     *
     * @return string
     */
    public function getLabel()
    {
        return 'Simple block'; // @translate
    }

    /**
     * The form() method is where the form for your block is defined.
     *
     * You can use the following helpers here for some common pieces of
     * the block form interface:
     *
     * - $view->blockAttachmentsForm($block) (to select items and media)
     * - $view->blockThumbnailTypeSelect($block) (to select the "size" of images to show)
     * - $view->blockShowTitleSelect($block) (to select where displayed attachment titles should come from)
     *
     * You can use form elements more or less as usual here, but you'll
     * want to take care with the names of your form elements: the form
     * expects all your custom elements to have names starting with the
     * following prefix:
     *
     * `o:block[__blockIndex__][o:data]`
     *
     * Anything starting with that prefix will automatically be saved to
     * the block's `data` property.
     *
     * @return string
     */
    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        return $view->blockAttachmentsForm($block);
    }

    /**
     * render() is pretty much the opposite of form(): it's where you
     * define the output of the block for the public side.
     *
     * This is the heart of a block layout: everything you collect on
     * form will get used here for the display.
     *
     * You'll generally be working with $block here, the block's API
     * representation, which gives you access to all the saved data
     * about the block. In particular, you might use:
     *
     * `$block->attachments()` (returns all attached items/media from the form)
     * `$block->dataValue($key)` (get a saved custom data value)
     *
     * @return string
     */
    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        return $view->partial('common/block-layout/simple-block', [
            'block' => $block,
        ]);
    }

    /**
     * prepareRender() is an optional method (it's defined as a blank method by
     * the abstract block layout class). Its purpose is to run once per page if this
     * block is used any number of times on the page.
     *
     * Typical usage is to load required CSS or JS for displaying the block, since
     * those loaded assets can generally be loaded just once and used across many
     * instances of the same block.
     *
     * prepareRender() will run before render().
     */
    public function prepareRender(PhpRenderer $view)
    {
        $view->headLink()
            ->appendStylesheet($view->assetUrl('vendor/slick/slick.css', 'SimpleBlock'))
            ->appendStylesheet($view->assetUrl('vendor/slick/slick-theme.css', 'SimpleBlock'))
            ->appendStylesheet($view->assetUrl('css/simple-block-carousel.css', 'SimpleBlock'));
        $view->headScript()
            ->appendFile($view->assetUrl('vendor/slick/slick.min.js', 'SimpleBlock'))
            ->appendFile($view->assetUrl('js/simple-block-carousel.js', 'SimpleBlock'));
    }
}
