<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link <?php if($groups=="USER"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_parameter/?groups=USER')">Pengguna</a></li>
	<li class="nav-item"><a class="nav-link <?php if($groups=="PENUMPANG"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_parameter/?groups=PENUMPANG')">Penumpang</a></li>
	<li class="nav-item"><a class="nav-link <?php if($groups=="RUTE"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_parameter/?groups=RUTE')">Rute</a></li>
	<li class="nav-item"><a class="nav-link <?php if($groups=="NAKHODA"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_parameter/?groups=NAKHODA')">Nakhoda</a></li>
</ul>