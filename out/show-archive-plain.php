<?php if (!empty($data)): ?>
    <table class="table table-hover">
       <thead>
        <tr>
            <th>Rank</th>
            <th>Rating</th>
            <th>Title</th>
            <th>Year</th>
            <th>Votes</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ( $data as $item ): ?>
        <tr>
            <td><?php echo $item['rank']; ?></td>
            <td><?php echo $item['rating']; ?></td>
            <td><?php echo $item['title']; ?></td>
            <td><?php echo $item['year']; ?></td>
            <td><?php echo $item['votes']; ?></td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="message notice">Sorry..No results there found for selected date.</div>
<?php endif; ?>