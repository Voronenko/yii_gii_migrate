<?php echo '<?php'; ?>

class <?php echo $this->_migrateName; ?> extends EDbMigration
{
	public function up()
	{

        <?php if ($this->alreadyAppliedCode !=''):?>

          $getcurrentdb = $this->getDbConnection()->createCommand("SELECT DATABASE( ) AS DBName")->queryScalar();

          $command = $this->getDbConnection()->createCommand("<?php echo addslashes ($this->alreadyAppliedCode); ?>");
          $command->bindParam(":CURRENTDB",$getcurrentdb,PDO::PARAM_STR);
          if (!$command->queryRow()) {
        <?php endif;?>

		$this->execute("<?php echo addslashes ($this->code); ?>");

       <?php if ($this->alreadyAppliedCode !=''):?>
           }
       <?php endif;?>


<?php if($this->clearCache):?>
		if(Yii::app()->hasComponent('cache'))
		{
			Yii::app()->getComponent('cache')->flush();
			echo "Cache flused\n";
		}
<?php endif;?>
		
<?php if($this->clearAssets): ?>
		$this->clearAssets();
<?php endif; ?>
	}
	
<?php if($this->clearAssets): ?>
	private function clearAssets()
	{
		$path = Yii::app()->getComponent('assetManager')->getBasePath();
		$this->clearDir($path);
		echo "Assets clear\n";
	}

	private function clearDir($folder, $main=true)
	{
		if(is_dir($folder))
		{
			$handle = opendir($folder);
			while($subfile = readdir($handle))
			{
				if($subfile == '.' || $subfile == '..')
					continue;
				if(is_file($subfile))
					unlink("{$folder}/{$subfile}");
				else
					$this->clearDir("{$folder}/{$subfile}", false);
			}
			closedir($handle);
			if(!$main)
				rmdir($folder);
		}
		else
			unlink($folder);
	}
<?php endif; ?>

	public function down()
	{
		echo "<?php echo $this->_migrateName; ?> does not support migration down.\n";
		return false;
		
		$this->execute("");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
