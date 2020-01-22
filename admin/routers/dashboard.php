<?php 
/**
 * Dashboard template
 * @version 1.0.0
 * @author Miriam Habiba Khenissi
 */

$limit = 10;
$selectedOffset = isset($_GET['offset']) && !empty($_GET['offset']) ? (intval($_GET['offset']) - 1) : 0;
$offset = $selectedOffset * $limit;

//Get list of posts.
$sql = "
    SELECT * FROM ( 
        SELECT DISTINCT idGallery FROM gallery AS G 
        INNER JOIN meta AS M ON M.picture_id = G.idGallery 
        LIMIT $offset,$limit
    ) AS ID 
    INNER JOIN gallery AS G ON G.idGallery = ID.idGallery 
    INNER JOIN meta AS M ON M.picture_id = G.idGallery 
    AND M.meta_key = 'visibility' ORDER BY orderGallery DESC
";
$query = mysqli_query($conn, $sql);
$list = [];
while ($row = mysqli_fetch_assoc($query)) {
	$list[] = $row;
}

//Get the total number
$sql = "SELECT COUNT(idGallery) AS count FROM gallery";
$query = mysqli_query($conn, $sql);
$total = mysqli_fetch_assoc($query)['count'];
$pages = ceil($total/$limit);


//Create next and previous pagination link.
$prev_pagination_url = $selectedOffset == 0 ? '#' : add_url_var(get_current_url(),'offset',($selectedOffset));
$next_pagination_url = ($selectedOffset+1) >= $pages ? '#' : add_url_var(get_current_url(),'offset',(($selectedOffset+1)+1));

?>

<div class="dashboard-page page-container">
	<div class="header">
		<h2 class="page-title">Dashboard</h2>
	</div>

	<div class="table-content">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th style="width: 54%" scope="col">Title</th>
					<th scope="col">Visibility</th>
					<th scope="col" class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!$list) { ?>
					<tr>
						<th colspan="5" class="text-center">Nothing to show.</th>
					</tr>
				<?php }else {?>

					<?php foreach ($list as $item) { ?>
						<tr>
							<th><?= $item['idGallery'] ?></th>
							<td><?= $item['imgFullNameGallery'] ?></td>
							<td><?= $item['titleGallery'] ?></td>
							<td><?= $item['meta_value'] == 0 ? 'Public' : 'Private' ?></td>
							<td class="actions text-right">
								<a id="<?= $item['idGallery'] ?>" href="#" role="button" class="edit-btn btn btn-outline-primary btn-sm">Edit</a>
								<small> | </small>
								<a id="<?= $item['idGallery'] ?>" href="#" role="button" class="remove-btn btn btn-outline-danger btn-sm">Remove</a>
							</td>
						</tr>
						<tr id="<?= $item['idGallery'] ?>" class="edit-form" style="display: none">
							<td class="edit-form" colspan="5">Edit form here</td>
						</tr>
					<?php } ?>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th style="width: 54%" scope="col">Title</th>
					<th scope="col">Visibility</th>
					<th scope="col" class="text-right">Action</th>
				</tr>
			</tfoot>
		</table>

		<?php if($total > $limit) { ?>
		<nav class="pagination-wrap">
			<center>
				<ul class="pagination">
					<li class="page-item">
						<?php 
							echo sprintf(
								'<a class="page-link%s" %s aria-label="Next">',
								$prev_pagination_url == '#' ? ' disabled' : '',
								$prev_pagination_url !== '#' ? ' href="'.$prev_pagination_url.'"' : '',
							);
						?>						
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>
					<?php for ($i=0; $i < $pages; $i++) { ?>
						<li class="page-item <?= $i == $selectedOffset ? 'active' : '' ?>">
							<a class="page-link" href="<?= add_url_var(get_current_url(),'offset',($i+1)) ?>"><?= $i+1; ?></a>
						</li>
					<?php } ?>

					<li class="page-item">
						<?php 
							echo sprintf(
								'<a class="page-link%s" %s aria-label="Next">',
								$next_pagination_url == '#' ? ' disabled' : '',
								$next_pagination_url !== '#' ? ' href="'.$next_pagination_url.'"' : '',
							);
						?>
						
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</center>
		</nav>
		<?php } ?>
	</div>
</div>