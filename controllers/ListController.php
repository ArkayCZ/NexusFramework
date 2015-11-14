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
abstract class ListController extends Controller {

    //Content provider to serve is an interface to the database for list data
    private $contentProvider;
    //path to html layout for each single item
    private $itemLayoutPath;
    //items on a single page
    private $itemsPerPage;
    //the number of pages, gets calculated automatically
    private $pageCount;

    //data for the list items (array a arrays)
    private $listData;
    //the actual html layout for each single item (the content of $itemLayoutPath)
    private $itemLayout;

    //Must be called at the end of child's process method
    public function process($params) {
        if($this->itemLayoutPath == "")
            $this->itemLayout = LayoutManager::getLayout("default-item-layout");
        
        $this->itemLayout = Files::readString($this->itemLayoutPath);
        $this->pageCount = $this->getRowCount() / $this->itemsPerPage;
        
        $this->data['itemLayout'] = $this->itemLayout;
        $this->data['itemData'] = $this->listData;
    }

    /**
     * Sets content provider for the ListController
     * @param $contentProvider
     */
    public function setContentProvider($contentProvider) {
        $this->contentProvider = $contentProvider;
    }

    /**
     * Sets the number of items per page
     * @param $number
     */
    public function setPerPage($number) {
        $this->itemsPerPage = $number;
    }

    /**
     * @param $path
     */
    public function setItemLayout($path) {
        $this->itemLayoutPath = $path;
    }

}