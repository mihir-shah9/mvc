<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Media extends \Controller\Core\Admin
{
    protected $productMedia = null;

    public function mediaSaveAction()
    {
        // print_r($_FILES);
        $productMedia = \Mage::getModel('Model\Product\Media');
        $photo = $_FILES['image']['name'];
        $temName = $_FILES['image']['tmp_name'];
        $path = 'skin\Product\Image\\';
        move_uploaded_file($temName, $path . $photo);

        $productMedia->image = $photo;
        $productMedia->productId = $this->getRequest()->getGet('id');
        $productMedia->save();
        $this->redirect('test', 'dashboard');
    }

    public function mediaUpdateAction()
    {
        $productMedia = $this->getRequest()->getPost('image');
        $ModelMedia = \Mage::getModel('Model\Product\Media');
        $productId = $this->getRequest()->getGet('id');
        $query = "SELECT * FROM `productmedia` WHERE productId = `{$productId}`";
        $allmedia = $ModelMedia->fetchAll();

        if ($allmedia) {
            foreach ($allmedia->getData() as $ModelMedia) {
                $ModelMedia->small = 0;
                $ModelMedia->thumb = 0;
                $ModelMedia->base = 0;
                if ($productMedia['small'] == $ModelMedia->mediaId) {
                    $ModelMedia->small = 1;
                }
                if ($productMedia['thumb'] == $ModelMedia->mediaId) {
                    $ModelMedia->thumb = 1;
                }
                if ($productMedia['base'] == $ModelMedia->mediaId) {
                    $ModelMedia->base = 1;
                }
                if (array_key_exists($ModelMedia->mediaId, $productMedia['data'])) {
                    $ModelMedia->label = $productMedia['data'][$ModelMedia->mediaId]['label'];
                    $ModelMedia->gallery = 0;
                    if (array_key_exists('gallery', $productMedia['data'][$ModelMedia->mediaId])) {
                        $ModelMedia->gallery = 1;
                    }
                }
                $ModelMedia->save();
            }
        }
    }

    public function mediaDeleteAction()
    {
        $ModelMedia = \Mage::getModel('Model\Product\Media');
        $productMedia = $this->getRequest()->getPost('image');
        $ModelMedia1 = \Mage::getModel('Model\Product\Media');
        foreach ($productMedia['remove'] as $key => $value) {
            $query = "SELECT `image` FROM `productmedia` WHERE `mediaId`= '{$key}';";
            $ModelMedia = $ModelMedia->fetchAll($query);
            foreach ($ModelMedia->getData() as $name) {
                unlink('C:\xampp\htdocs\PHP\Advance PHP\15-02-2021\skin\Product\Image\\' . $name->image);
            }
            $ModelMedia1->delete($key);
        }
    }
}
