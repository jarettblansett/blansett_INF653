<?php include('header.php'); ?>

<h1>Zippy Used Autos</h1>

<!-- Sort Options -->
<form action="index.php" method="get">
    <label>Sort by:</label>
    <select name="sort" onchange="this.form.submit()">
        <option value="price">Price (High → Low)</option>
        <option value="year" <?php if ($sort === 'year') echo 'selected'; ?>>Year (Newest → Oldest)</option>
    </select>
</form>

<!-- Filter by Make -->
<form action="index.php" method="get">
    <label>Filter by Make:</label>
    <select name="make_id" onchange="this.form.submit()">
        <option value="">All Makes</option>
        <?php foreach ($makes as $make) : ?>
            <option value="<?= $make['make_id']; ?>">
                <?= $make['make_name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- by Type -->
<form action="index.php" method="get">
    <label>Filter by Type:</label>
    <select name="type_id" onchange="this.form.submit()">
        <option value="">All Types</option>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id']; ?>">
                <?= $type['type_name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- by Class -->
<form action="index.php" method="get">
    <label>Filter by Class:</label>
    <select name="class_id" onchange="this.form.submit()">
        <option value="">All Classes</option>
        <?php foreach ($classes as $class) : ?>
            <option value="<?= $class['class_id']; ?>">
                <?= $class['class_name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- Vehicle List -->
<table>
    <tr>
        <th>Year</th>
        <th>Model</th>
        <th>Price</th>
        <th>Make</th>
        <th>Type</th>
        <th>Class</th>
    </tr>

    <?php foreach ($vehicles as $v) : ?>
        <tr>
            <td><?= $v['year']; ?></td>
            <td><?= $v['model']; ?></td>
            <td>$<?= number_format($v['price']); ?></td>
            <td><?= $v['make_name']; ?></td>
            <td><?= $v['type_name']; ?></td>
            <td><?= $v['class_name']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include('footer.php'); ?>
