<?php
$filterData = $this->data['form']->getData();
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Users</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/addButton.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/table.css" type="text/css" rel="stylesheet">
  <link href="/css/messages.css" type="text/css" rel="stylesheet">
  <link href="/css/filter.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Users</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/messages.php'; ?>

  <div class="add">
    <a href="/users/create" class="button">Create new user</a>
  </div>

  <div class="filter">
    <form method="get">
      <label for="limit">Show: </label>
      <select name="page[limit]" class="page-limit" id="limit">
        <option <?php if ($filterData['page']['limit'] == 5) {
            echo 'selected';
        } ?> >5
        </option>
        <option <?php if ($filterData['page']['limit'] == 10) {
            echo 'selected';
        } ?> >10
        </option>
        <option <?php if ($filterData['page']['limit'] == 15) {
            echo 'selected';
        } ?> >15
        </option>
        <option <?php if ($filterData['page']['limit'] == 20) {
            echo 'selected';
        } ?> >20
        </option>
      </select>
      <input class="page-offset" name="page[offset]" value="<?php echo $filterData['page']['offset'] ?>" hidden>
      <input name="filter[login]" value="<?php echo $filterData['filter']['login'] ?>" type="text">
      <label for="role">Role: </label>
      <select id="role" name="filter[role]">
        <option value=""></option>
          <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <option value="<?php echo $role ?>"
                <?php if ($role === $filterData['filter']['role']) {
                    echo 'selected';
                } ?>>
                <?php echo $role ?>
            </option>
          <?php } ?>
      </select>
      <input class="filter-field" name="order_by" value="<?php echo $filterData['order_by'] ?>" hidden>
      <input class="filter-direction" name="order_dir" value="<?php echo $filterData['order_dir'] ?>" hidden>
      <button type="submit" class="apply">Apply Filter</button>
      <button type="reset" class="reset">Reset Filter</button>
    </form>
  </div>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
      <th data-field="login" class="order-field <?php
      if ($filterData['order_dir'] === 'login') {
          echo ($this->data['order_dir'] === 'asc') ? 'asc' : 'desc';
      }
      ?>">Login
      </th>
      <th data-field="role" class="order-field <?php
      if ($filterData['order_dir'] === 'role') {
          echo ($this->data['order_dir'] === 'asc') ? 'asc' : 'desc';
      }
      ?>">Role
      </th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['users'] as $user) { ?>
      <tr>
        <td><?php echo $user['login'] ?></td>
        <td><?php echo $user['role'] ?></td>
        <td>
          <div class="actions">
            <a href="/users/<?php echo $user['id']; ?>/edit" class="button">Edit</a>
            <a href="/users/<?php echo $user['id']; ?>/delete" class="button">Delete</a>
          </div>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

  <div class="pagination">
    <div class="pagination-pages">

      <button class="pagination-prev">«</button>
      <button class="pagination-next">»</button>

    </div>
    <div class="pages">
        <?php $currentPage = $this->data['current_page'] ?? 1 ?>
      <div class="current-page" data-value="<?php $currentPage ?>"><?php echo $this->data['current_page'] ?? 1 ?></div>
      <div class="separator"></div>
        <?php $countPages = $this->data['count_pages'] ?? 1 ?>
      <div class="count-pages" data-value="<?php $countPages ?>"><?php echo $this->data['count_pages'] ?? 1 ?></div>
    </div>
  </div>

    <?php require __DIR__.'/../Core/footer.php'; ?>
  <script type="text/javascript" src="/js/filter.js"></script>
</div>
</body>
</html>
