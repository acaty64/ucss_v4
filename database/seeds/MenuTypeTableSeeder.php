<?php

use App\Type;
use Illuminate\Database\Seeder;

class MenuTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = Type::find(1);
        $type->menus()->sync([
1 => ['level' => 0, 'order' => 0, ],
2 => ['level' => 0, 'order' => 1, ],
3 => ['level' => 0, 'order' => 2, ],
4 => ['level' => 1, 'order' => 2, ],
5 => ['level' => 2, 'order' => 2, ],
6 => ['level' => 0, 'order' => 3, ],
7 => ['level' => 0, 'order' => 4, ],

            ]);
        $type = Type::find(2);
        $type->menus()->sync([
1 => ['level' => 0, 'order' => 0, ],
8 => ['level' => 0, 'order' => 1, ],

            ]);
        $type = Type::find(3);
        $type->menus()->sync([
1 => ['level' => 0, 'order' => 0, ],
9 => ['level' => 0, 'order' => 1, ],
10 => ['level' => 0, 'order' => 2, ],
11 => ['level' => 1, 'order' => 2, ],
12 => ['level' => 2, 'order' => 2, ],
13 => ['level' => 0, 'order' => 3, ],

            ]);
        $type = Type::find(4);
        $type->menus()->sync([
1 => ['level' => 0, 'order' => 0, ],
9 => ['level' => 0, 'order' => 1, ],
10 => ['level' => 0, 'order' => 2, ],
11 => ['level' => 1, 'order' => 2, ],
12 => ['level' => 2, 'order' => 2, ],
13 => ['level' => 0, 'order' => 3, ],
14 => ['level' => 0, 'order' => 4, ],

           ]);
        $type = Type::find(5);
        $type->menus()->sync([
1 => ['level' => 0, 'order' => 0, ],
15 => ['level' => 0, 'order' => 1, ],
16 => ['level' => 0, 'order' => 2, ],
17 => ['level' => 1, 'order' => 2, ],
18 => ['level' => 2, 'order' => 2, ],
19 => ['level' => 0, 'order' => 3, ],
20 => ['level' => 1, 'order' => 3, ],
21 => ['level' => 2, 'order' => 3, ],
22 => ['level' => 0, 'order' => 4, ],
23 => ['level' => 1, 'order' => 4, ],

            ]);

    }

}
