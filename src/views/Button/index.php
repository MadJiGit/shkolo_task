<?php include 'src/views/header.php'; ?>
<div class="dashboard">
    <?php foreach ($buttons as $id => $button): ?>
        <div class="cell" style="background-color: <?= htmlspecialchars($button['color'] ?? 'white') ?>;">
            <?php if (!empty($button['link'])): ?>
                <div class="button-container">
                    <a href="<?= htmlspecialchars($button['link']) ?>" class="button-link" target="_blank">
                        <span class="plus-icon"> <?= htmlspecialchars($button['title']); ?> </span>
                    </a>
                    <button class="extra-button" data-edit-id="<?= $id ?>">✏️</button>
                    <button class="delete-button" data-id="<?= $id ?>">🗑️</button>
                </div>
            <?php else: ?>
                <a href="index.php?action=edit&id=<?= $id ?>" class="button-link" >
                    <img src="public/img/button.png" alt="Add Button" class="empty-button-icon">
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>


