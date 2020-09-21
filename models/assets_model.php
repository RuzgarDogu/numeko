<?php

class Assets_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAssetList()
    {
      return $this->db->select("SELECT a.id, a.brand, a.model, a.serino, m.maint_valid, m.maint_name, ast.type_name FROM assets a LEFT JOIN( SELECT maint_valid, asset_id, id, maint_name FROM maint WHERE id IN( SELECT MAX(id) FROM maint GROUP BY asset_id ) ) AS m ON m.asset_id = a.id LEFT JOIN asset_types ast ON a.type = ast.astid");
    }

    public function deleteAsset($id)
    {
      $this->db->select("DELETE FROM `assets` WHERE `id` = {$id}");
      return "success";
    }
    public function deleteMaint($id)
    {
      $this->db->select("DELETE FROM `maint` WHERE `asset_id` = {$id}");
      return true;
    }

    public function addMaintenance($bakimciadi,$bakimtarihi,$bakimvalid,$h_assetid)
    {
      $this->db->select("INSERT INTO `maint`(`asset_id`, `maint_name`, `maint_date`, `maint_valid`) VALUES ({$h_assetid},'{$bakimciadi}','{$bakimtarihi}', '{$bakimvalid}')");
    }

    public function assetTypes()
    {
      return $this->db->select("SELECT * FROM asset_types");
    }

    public function addAssetType($yeni_type)
    {
      $this->db->select("INSERT INTO asset_types (type_name) VALUES ('{$yeni_type}')");
      return $this->db->lastInsertId();
    }

    public function addAsset($type,$brand,$model,$serino)
    {
      $this->db->select("INSERT INTO `assets`(`type`, `brand`, `model`, `serino`) VALUES ('{$type}','{$brand}','{$model}','{$serino}')");
    }

}
