
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        <div class="relative mt-4">
            <select id="table-filter-status" class="block p-2 pl-3 pr-8 text-sm text-gray-900 border border-gray-300 rounded-lg w-48 bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">All</option>
                <option value="khả dụng">Active</option>
                <option value="vô hiệu">Inactive</option>
            </select>
        </div>
    </div>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3" style="width:10px">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Giá trị nạp
                </th>
                <th scope="col" class="px-6 py-3">
                    Button
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'C:\Users\dungv\Desktop\DA1\controller_admin\controller_admin_account.php';
            include 'C:\Users\dungv\Desktop\DA1\model\connect.php';
            $users = getUserRecharge($conn);
            if (count($users) > 0) {
            foreach ($users as $user) {
                        echo'
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 user-row">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                        ' . $user["id"] . '
                        </td>
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white user-name">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="pl-3">
                                <div class="text-base font-semibold">' . $user["username"] . '</div>
                                <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                            </div>  
                        </th>
                        <td class="px-6 py-4">
                        ' . $user["recharge_amount_pending"] . '
                        </td>';
                        echo '
                        <td class="px-6 py-4">';
                            echo '<a href="/admin/admin_control.php?link=users-change-status&&name=' . $user["username"] . '" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Duyệt nạp tiền
                            </span></a>';  
                        echo '
                        </td>';
                        echo '
                        <td class="px-6 py-4">';
                            echo '<a href="/admin/admin_control.php?link=users-change-status&&cancel=' . $user["username"] . '" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">                        
                                Hủy nạp</a>';  
                        echo '
                        </td>';
                        
                        
                    echo'</tr>';
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='4'>Không có tài khoản nào đang chờ duyệt nạp tiền.</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</div>




</body>
</html>
