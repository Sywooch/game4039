<?php if(!defined('UC_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header_client');?>
<br />
<table cellpadding="0" cellspacing="0" class="msg" style="width: 65%" align="center">
	<thead>
		<tr>
			<th>提示信息</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $message;?><br />
			<?php if($redirect == 'BACK') { ?>
				<a href="###" onclick="history.back();"> 点击这里返回 </a>
			<?php } elseif($redirect) { ?>
				<a href="<?php echo $redirect;?>"> 页面将在 3 秒后自动跳转到下一页，点击这里直接跳转... </a>
				<script type="text/javascript">
				function redirect(url, time) {
					setTimeout("window.location='" + url + "'", time * 1000);
				}
				redirect('<?php echo $redirect;?>', 3);
				</script>
			<?php } ?>
			</td>
		</tr>
	</tbody>
</table>
</div>

<?php include $this->gettpl('footer_client');?>