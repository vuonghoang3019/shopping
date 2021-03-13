<?php
namespace App\Components;
use App\Models\Menu;
class MenuRecursive
{
    private $html;
    public function __construct()
    {
        $this->html = '';
    }
    public function menuRecursive($parentID = 0,$subMark = '')
    {
        $data = Menu::where('parent_id',$parentID) -> get();
        foreach ($data as $item)
        {
            $this->html .= '<option value="'.$item->id.'">'. $subMark .$item->name.'</option>';
            $this->menuRecursive($item->id, $subMark .'--');
        }
        return $this->html;
   }
    public function menuRecursiveEdit($parentIDmenuEdit,$parentID = 0,$subMark = '')
    {
        $data = Menu::where('parent_id',$parentID) -> get();
        foreach ($data as $item)
        {
            if($parentIDmenuEdit == $item->id)
            {
                $this->html .= '<option selected value="'.$item->id.'">'. $subMark .$item->name.'</option>';
            }
            else
            {
                $this->html .= '<option value="'.$item->id.'">'. $subMark .$item->name.'</option>';
            }
            $this->menuRecursiveEdit($parentIDmenuEdit,$item->id, $subMark .'--');
        }
        return $this->html;
    }
}
