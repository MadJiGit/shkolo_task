<?php include 'src/views/header.php'; ?>
<?php
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ($button['id'] ?? '');
$title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : ($button['title'] ?? '');
$link = isset($_GET['link']) ? htmlspecialchars($_GET['link']) : ($button['link'] ?? '');
$selectedColor = isset($button['color']) && !empty($button['color']) ? $button['color'] : '';
?>
<div class="config-container">
    <form action="index.php?action=save" method="POST" >

        <input type="hidden" name="id" value="<?= $id ?>">
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message" id="errorMessage">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= $title ?>" required>

        <label for="link">Link:</label>
        <input type="url" id="link" name="link" value="<?= $link ?>" required>

        <label for="color">Color:</label>
        <select id="color" name="color">
            <option value="" <?= $selectedColor === 'white' ? 'selected' : '' ?> disabled>Choose your color</option>
            <option value="red" <?= $selectedColor === 'red' ? 'selected' : '' ?>>Red</option>
            <option value="blue" <?= $selectedColor === 'blue' ? 'selected' : '' ?>>Blue</option>
            <option value="green" <?= $selectedColor === 'green' ? 'selected' : '' ?>>Green</option>
            <option value="yellow" <?= $selectedColor === 'yellow' ? 'selected' : '' ?>>Yellow</option>
        </select>

        <button type="submit">Save</button>
    </form>
    <button class="back-button">Back</button>
</div>
</body>
</html>
