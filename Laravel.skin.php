<?php

/**
 * Skin file for skin Laravel.
 *
 * @file
 * @ingroup Skins
 */

class SkinLaravel extends SkinTemplate {

	public $skinname = 'laravel-io-wiki-skin', $stylename = 'laravel-io-wiki-skin',
		$template = 'LaravelTemplate', $useHeadElement = true;

	public function setupSkinUserCss(OutputPage $out)
	{
		parent::setupSkinUserCss($out);

		$out->addModuleStyles('skins.laravel-io-wiki-skin');
	}

}
class LaravelTemplate extends BaseTemplate {

	public function execute()
	{
		global $wgUser;

		wfSuppressWarnings();

		$this->html('headelement');
?>

<div class="top-navigation">
    <div class="contain">
        <ul>
        	<li><a href="http://laravel.io">Laravel.io</a></li>
            <li><a href="http://forums.laravel.io">Forums</a></li>
            <li><a href="http://irclogs.laravel.io">IRC Logs</a></li>
        </ul>

        <div class="search-box">
        	<form action="<?php $this->text( 'wgScript' ); ?>" id="searchform" class="mw-search">
        		<?php echo $this->makeSearchInput(array('placeholder' => 'Search...', 'id' => 'searchInput') ); ?><button type="submit"><i class="icon-search"></i></button>
        	</form>
        </div>
    </div>
</div>

<header>
	<img src="<?php echo $this->getSkin()->getSkinStylePath('assets/images/laravel-io-wiki-logo.png'); ?>" />

	<nav class="contain">
		<ul>
			<li class="menu">
				<?php echo Linker::link(Title::newFromText('Laravel.io Wiki'), 'Main Page <i class="icon-chevron-down"></i>'); ?>

				<ul>
					<li></li>
					<li><?php echo Linker::link(Title::newFromText('Special:RecentChanges'), 'Recent Changes'); ?></li>
					<li><?php echo Linker::link(Title::newFromText('Special:Help'), 'Help'); ?></li>
				</ul>
			</li>
			<li class="menu">
				<?php echo Linker::link(Title::newFromText('Laravel 3'), 'Laravel 3 <i class="icon-chevron-down"></i>'); ?></a>

				<ul>
					<li></li>
					<li><?php echo Linker::link(Title::newFromText('A Beginner\'s Guide to Laravel 3'), 'Beginner\'s Guide'); ?></li>
				</ul>
			</li>
			</li>
			<li class="menu">
				<?php echo Linker::link(Title::newFromText('Laravel 4'), 'Laravel 4 <i class="icon-chevron-down"></i>'); ?></a>

				<ul>
					<li></li>
					<li><?php echo Linker::link(Title::newFromText('A Beginner\'s Guide to Laravel 4'), 'Beginner\'s Guide'); ?></li>
				</ul>
			</li>
			<li>
				<?php echo Linker::link(Title::newFromText('Laracon')); ?>
			</li>
			<li class="menu">
				<span>Toolbox <i class="icon-chevron-down"></i></span>

				<ul>
					<li></li>

					<?php foreach ($this->getToolbox() as $key => $item): ?>
					<?php echo $this->makeListItem($key, $item); ?>
					<?php endforeach; ?>

					<?php wfRunHooks('SkinTemplateToolboxEnd', array(&$this)); ?>
				</ul>
			</li>

			<?php if ($wgUser->isLoggedIn()): ?>
			<li class="menu highlighted">
				<?php $personalTools = $this->getPersonalTools(); $talk = array_shift($personalTools); ?>

				<a href="<?php echo $talk['links'][0]['href']; ?>"><?php echo $wgUser->getName(); ?> <i class="icon-chevron-down"></i></a>

				<ul>
					<li></li>
					<?php foreach ($personalTools as $key => $item): ?>
					<?php echo $this->makeListItem($key, $item); ?>
					<?php endforeach; ?>
				</ul>

			</li>
			<?php else: ?>

			<li class="highlighted">
				<?php echo Linker::link(Title::newFromText('Special:RequestAccount'), 'Request Account'); ?>
			</li>
			<li class="highlighted">
				<a href="<?php echo $this->data['personal_urls']['anonlogin']['href']; ?>">Sign in</a>
			</li>

			<?php endif; ?>
		</ul>
	</nav>
</header>

<section class="page contain">
	
	<?php if ($this->data['newtalk']): ?>
	<div class="warningbox">
		<?php $this->html('newtalk'); ?>        	
	</div>
	<?php endif; ?>

	<div class="page-header group">
		<ul>

<?php

	$headerLinks = $this->data['content_navigation']['namespaces'] + $this->data['content_navigation']['views'];

	// If the "view" link is available we'll unset it as it's the same as the page link.
	if (isset($headerLinks['view'])) unset($headerLinks['view']);

	foreach ($headerLinks as $key => $item):
		echo $this->makeListItem($key, $item);
	endforeach;

	// If the "actions" namespace is available then the user can do things like delete
	// or move the page. We'll show these in a dropdown.
	if ( ! empty($this->data['content_navigation']['actions'])):
?>
	
		<li class="actions">
			<span><i class="icon-chevron-down"></i></span>

			<ul>
			<?php foreach ($this->data['content_navigation']['actions'] as $key => $item) echo $this->makeListItem($key, $item); ?>
			</ul>
		</li>

<?php
	endif;
?>
		</ul>
	</div>

	<div class="page-main">
		<h1><?php $this->html('title') ?></h1>

    	<?php $this->html('bodytext') ?>

    	<div class="group"><?php $this->html('catlinks'); ?></div>

    	<?php $this->html('dataAfterContent'); ?>
    </div>

</section>

<footer>
	<div class="contain">
    	<p>
    		Copyright &copy; 2012-2013 Laravel.io
    	</p>
    	<p>
    		This wiki is not maintained, affiliated or involved with Laravel.com or any of its administrators. Please do not attempt to contact them in regards to issues with this wiki.
    	</p>
    </div>
</footer>

<div id="mw-js-message" style="display:none;"></div>

<?php $this->printTrail(); ?>

<script src="<?php echo $this->getSkin()->getSkinStylePath('assets/javascripts/sticky.js'); ?>"></script>
<script>
	$(document).ready(function(){
		$('#toc').wrap('<div class="page-left" />');

		$('.page-left').insertBefore('.page-main').sticky();
	});
</script>

</body>
</html>

<?php
		wfRestoreWarnings();
	}
}
?>