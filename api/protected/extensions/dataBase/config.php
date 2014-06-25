<?php
return CMap::mergeArray(
		array(
				'version' => '0.1',
				'last_modify_time' => '2009-12-14',
				'media_types' => array(
						// 图片文件
						'picture' => array('*.jpg', '*.jpeg', '*.gif', '*.png'),
						// 文档文件
						'docs' => array('*.wps', '*.doc', '*.docx', '*.xls', '*.xlsx', '*.pdf'),
						// 压缩文件
						'zip' => array('*.7z', '*.zip', '*.rar'),
				),
		)
);