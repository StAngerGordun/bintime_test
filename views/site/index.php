<?php

/* @var $this yii\web\View */

$this->title = 'Home';

?>
<table class="table ">
    <thead class="table-inverse">
    <tr>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Login</th>
        <th>Password</th>
        <th>Created At</th>
        <th>Addresses</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $key => $user)
    {
        //var_dump($user->addresses);
        ?>

        <tr>
            <th scope="row"><?= $user->name ?></th>
            <td><?= $user->surname ?></td>
            <td><?= $user->gender->name ?></td>
            <td><?= $user->login ?></td>
            <td><?= $user->password ?></td>
            <td><?= $user->created_at ?></td>
            <td>
                <div class="site-index dropdown">
                    <button class="more-button btn btn-link" type="button" data-toggle="dropdown">Addresses details
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                        
                        foreach ($user->addresses as $address)
                        {
                            
                            ?>
                            <li>■ <?=$address->postal_code . ', ' . $address->country . ', ' . $address->city
                                . ', ' . $address->street . ', ' . $address->street_number . ', ' . $address->office_number?></li>
                        <?php } ?>
                    </ul>
                </div>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>