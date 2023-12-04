<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php $this->load->view($template_f . 'component/header/header_meta_view'); ?>
	<?php $this->load->view($template_f . 'component/header/header_common_view'); ?>

	<!-- check load file css, js theo tung page -->
	<?php
	if (isset($header_page_css_js) && $header_page_css_js != '') {
		$this->load->view($template_f . 'component/header/pages/header_' . $header_page_css_js . '_view');
	}
	?>

</head>

<body class="hold-transition sidebar-mini layout-fixed d-none">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="bds/add" class="nav-link">Thêm bất động sản</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="news/add" class="nav-link">Thêm tin tức</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="auction/add" class="nav-link">Thêm lịch đấu giá</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="document/add" class="nav-link">Thêm tài liệu luật</a>
				</li>

				<li class="nav-item d-none d-sm-inline-block">
					<a href="setting" class="nav-link">Cài đặt website</a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#" style="color: #161616;">
						<i class="fas fa-user" style="color: #858c93;"></i>
						Hi! <strong><?= $this->session->userdata('fullname'); ?></strong>
						<i class="fas fa-chevron-down" style="color: #858c93;"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a href="<?= ROOT_DOMAIN ?>" target="_blank" class="dropdown-item">
							<i class="fas fa-directions" style="color: #858c93;"></i> Trang người dùng
						</a>
						<div class="dropdown-divider"></div>

						<a href="<?= ROOT_DOMAIN . 'logout' ?>" class="dropdown-item">
							<i class="fas fa-sign-out-alt" style="color: #858c93;"></i> Thoát khỏi hệ thống
						</a>
						<div class="dropdown-divider"></div>

						<!-- <a href="#" class="dropdown-item">
							<div class="media">
								<img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										Brad Diesel
										<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">Call me whenever you can...</p>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
						</a> -->
						<!-- <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->
					</div>

				</li>

			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="images/logo-vuong.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">Admin - Đất đông anh</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex d-none">
					<div class="image">
						<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">Admin</a>
					</div>
				</div> -->

				<!-- SidebarSearch Form -->
				<div class="form-inline d-none">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href="home" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Trang Chủ
								</p>
							</a>

						</li>
						<!-- QUẢN LÝ NỘI DUNG -->
						<li class="nav-header">QUẢN LÝ BẤT ĐỘNG SẢN</li>
						<li class="nav-item">
							<a href="bds" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Bất động sản
									<!-- <i class="right fas fa-angle-left"></i> -->
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="choose_vip" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Quản lý tin VIP
								</p>
							</a>
						</li>

						<!-- TODO: chưa làm -->
						<!-- <li class="nav-item">
							<a href="project" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Dự án
								</p>
							</a>
						</li> -->

						<li class="nav-item">
							<a href="tag" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Từ khóa bđs
								</p>
							</a>
						</li>

						<li class="nav-header">QUẢN LÝ BÀI VIẾT</li>
						<li class="nav-item">
							<a href="news" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Tin tức
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="auction" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Lịch đấu giá đất
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="document" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Tài liệu luật
								</p>
							</a>
						</li>

						<li class="nav-header">QUẢN LÝ KHU VỰC</li>
						<li class="nav-item">
							<a href="street" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Đường
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="commune" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Xã
								</p>
							</a>
						</li>

						<li class="nav-header">QUẢN LÝ NGƯỜI DÙNG</li>
						<li class="nav-item">
							<a href="user" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Người dùng
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="contact" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Phản hồi người dùng
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="request_contact" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Yêu cầu liên hệ lại
								</p>
							</a>
						</li>

						<li class="nav-header">KHÁC</li>
						<li class="nav-item">
							<a href="setting" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Cài đặt website
								</p>
							</a>
						</li>

						<!-- CÀI ĐẶT WEBSITE -->
						<!-- <li class="nav-header">CÀI ĐẶT WEBSITE</li> -->
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<script>
			$(document).ready(function() {
				let menu_current = '<?= $this->uri->rsegments[1] ?>';
				let sub1_current = '<?= $this->uri->rsegments[1] ?>/<?= $this->uri->rsegments[2] ?>';
				$('.nav-sidebar > .nav-item').each(function() {
					let menu = $(this).find('a').attr('href');
					if (menu == menu_current) {
						// $(this).addClass('menu-open'); // mo menu
						$(this).find('a').eq(0).addClass('active'); // active menu

						$(this).find('ul.nav-treeview li').each(function() {
							let menusub = $(this).find('a').attr('href');
							if (menusub == sub1_current) {
								$(this).find('a').addClass('active');
							}
						})
					}
				})

				$('body').removeClass('d-none')
			});
		</script>