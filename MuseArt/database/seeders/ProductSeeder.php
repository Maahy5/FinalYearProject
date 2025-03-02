<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::create([
            'name' => 'Girl with a Pearl Earring',
            'image' => 'images/art1.jpg',
            'description' => 'Oil Painting By Johannes Vermeer',
            'long_description' => 'The girls enigmatic expression and the reflective pearl earring evoke themes of innocence, elegance, and curiosity. The simplicity of the composition draws attention to her gaze, leaving the viewer to interpret her emotions.',
            'price' => 100.00,
        ]);

        Product::create([
            'name' => 'Letting Go',
            'image' => 'images/art2.png',
            'description' => 'Acrylic Painting By Johannes Vermeer',
            'long_description' => 'Though fictional under Vermeers name, "Letting Go"symbolizes the release of control, emotions, or burdens. The title suggests a narrative of freedom or acceptance, with an emphasis on the emotional experience rather than realism.',
            'price' => 100.00,
        ]);


        Product::create([
            'name' => 'Irises May 1889',
            'image' => 'images/art3.png',
            'description' => 'Oil Painting By Vincent Van Gogh',
            'long_description' => 'Van Gogh’s irises are believed to reflect his mental state during his stay at the asylum. The vibrant flowers and swirling patterns convey a sense of vitality and movement, contrasted with the solitude he experienced at the time. It’s often interpreted as a meditation on life, beauty, and fragility',
            'price' => 100.00,
        ]);


        Product::create([
            'name' => 'Oriental Poppies, 1928',
            'image' => 'images/art4.png',
            'description' => 'Oil Painting By Georgia O Keeffe',
            'long_description' => 'The exaggerated size and intense color of the poppies force the viewer to focus on the intricacies of the flower, encouraging a sense of awe and a closer relationship with nature’s power and vibrancy.',
            'price' => 10.00,
        ]);

        Product::create([
            'name' => 'Fourteen Sunflowers in a vase Arles 1888',
            'image' => 'images/art5.png',
            'description' => 'Oil Painting By Vincent Van Gogh',
            'long_description' => 'Van Gogh’s sunflowers are often seen as a symbol of hope, warmth, and friendship. This particular series also reflects his exploration of the power of yellow as a color of optimism and his desire to bring joy to his viewers. It’s a vibrant celebration of life and nature, expressed through simple, yet bold subject matter.',
            'price' => 100.00,
        ]);

        Product::create([
            'name' => 'Manhattan Bridge',
            'image' => 'images/manhattan.png',
            'description' => 'Oil Painting By Edward Hopper',
            'long_description' => 'Edward Hopper’s works typically explore themes of urban isolation and industrial beauty. A painting like "Manhattan Bridge" likely captures the quiet, imposing presence of the bridge amidst a bustling city, symbolizing the coexistence of progress and solitude. Hopper often invites viewers to reflect on the loneliness of modern life.',
            'price' => 100.00,
        ]);

        Product::create([
            'name' => 'Manjushree Thangka',
            'image' => 'images/thanka1.png',
            'description' => 'Thangka Art By Jamyang Phunstok',
            'long_description' => 'Manjushri Thanka is painted in the traditional Tibetan style and features vibrant acrylic colors and 24K gold accents, showcasing the revered Bodhisattva of Wisdom and Enlightened Insight.
                                   Manjushri, a revered figure, is depicted in a calm, composure posture, symbolizing his mastery over wisdom and knowledge. He wields the flaming sword of wisdom, Prajna Khadga, which cuts 
                                   through ignorance and delusion, and holds a lotus flower supporting the Prajnaparamita Sutra, a text representing wisdom perfection. His serene expression reflects his ability to provide clarity and insight.',
            'price' => 100.00,
        ]);
    }
}
