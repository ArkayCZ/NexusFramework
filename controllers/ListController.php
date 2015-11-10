<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 10.11.2015
 * Time: 18:26
 *
 * You can use this controller to create pages with lists of artices, for example. Pagination is
 * supported. You can set the layout for each individual item in the list as well as the pagination
 * numbers. Example layouts are included. Use variable names that correspond to keys in the array
 * provided by the controllers ContentProvider
 *
 */
class ListController extends Controller {

    private $contentProvider;
    private $itemLayoutPath;
    private $itemsPerPage;

    private $itemLayout;

    //Must be called at the end of child's process method
    public function process($params) {
        $this->itemLayout = Files::readString($this->itemLayoutPath);
    }

    public function setContentProvider($contentProvider) {
        $this->contentProvider = $contentProvider;
    }

    public function setItemLayout($path) {
        $this->itemLayoutPath = $path;
    }



}