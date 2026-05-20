<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'original_price',
        'image',
        'category',
        'description',
        'rating',
        'reviews_count',
        'is_popular',
        'is_new',
        'stock',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Accessor for formatted price (e.g., "15 000 F").
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' F';
    }

    /**
     * Accessor for formatted original price if it exists.
     */
    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if (!$this->original_price) {
            return null;
        }
        return number_format($this->original_price, 0, ',', ' ') . ' F';
    }

    /**
     * Return static products from "produits et prix.md"
     * bypassing the database.
     */
    public static function allStatic()
    {
        return collect([
            new static([
                'id' => 1,
                'name' => 'Boubou oversized',
                'slug' => 'boubou-oversized',
                'price' => 15000,
                'original_price' => 18000,
                'image' => 'product1.jpeg',
                'category' => 'Boubous',
                'description' => 'Un magnifique boubou ample de taille unique avec des finitions de couture impeccables. Parfait pour allier confort et élégance traditionnelle au quotidien.',
                'rating' => 4.8,
                'reviews_count' => 14,
                'is_popular' => true,
                'is_new' => false,
                'stock' => 8,
            ]),
            new static([
                'id' => 2,
                'name' => 'Robe élégante',
                'slug' => 'robe-elegante',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product2.jpeg',
                'category' => 'Robes',
                'description' => 'Robe de soirée élégante conçue dans des tissus légers de haute qualité. Silhouette moderne et fluide, idéale pour toutes vos occasions spéciales.',
                'rating' => 5.0,
                'reviews_count' => 22,
                'is_popular' => true,
                'is_new' => true,
                'stock' => 5,
            ]),
            new static([
                'id' => 3,
                'name' => 'Chemise chic',
                'slug' => 'chemise-chic',
                'price' => 12000,
                'original_price' => 15000,
                'image' => 'product3.jpeg',
                'category' => 'Ensembles',
                'description' => 'Chemise cintrée en coton égyptien avec col structuré et détails raffinés. Un indispensable pour une allure chic et soignée.',
                'rating' => 4.6,
                'reviews_count' => 9,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 12,
            ]),
            new static([
                'id' => 4,
                'name' => 'Ensemble short',
                'slug' => 'ensemble-short',
                'price' => 8000,
                'original_price' => null,
                'image' => 'product4.jpeg',
                'category' => 'Ensembles',
                'description' => 'Ensemble décontracté avec short et haut assorti en lin respirant. Parfait pour les sorties estivales et le confort de tous les jours.',
                'rating' => 4.5,
                'reviews_count' => 11,
                'is_popular' => false,
                'is_new' => true,
                'stock' => 7,
            ]),
            new static([
                'id' => 5,
                'name' => 'Gilet chic décontracté',
                'slug' => 'gilet-chic-decontracte',
                'price' => 8000,
                'original_price' => 10000,
                'image' => 'product5.jpeg',
                'category' => 'Gilets',
                'description' => 'Gilet léger sans manches, idéal pour superposer vos tenues quotidiennes. Texture douce et coupe décontractée tendance.',
                'rating' => 4.7,
                'reviews_count' => 15,
                'is_popular' => true,
                'is_new' => false,
                'stock' => 6,
            ]),
            new static([
                'id' => 6,
                'name' => 'Gilet contemporain',
                'slug' => 'gilet-contemporain',
                'price' => 8000,
                'original_price' => null,
                'image' => 'product6.jpeg',
                'category' => 'Gilets',
                'description' => 'Gilet au design moderne et épuré. Matière premium et coupe ajustée pour structurer élégamment toutes vos silhouettes professionnelles.',
                'rating' => 4.9,
                'reviews_count' => 18,
                'is_popular' => false,
                'is_new' => true,
                'stock' => 4,
            ]),
            new static([
                'id' => 7,
                'name' => 'Ensemble crop-top et jupe évasée',
                'slug' => 'ensemble-crop-top-et-jupe-evasee',
                'price' => 15000,
                'original_price' => 18000,
                'image' => 'product7.jpeg',
                'category' => 'Ensembles',
                'description' => 'Un ensemble féminin audacieux et ultra-tendance. La jupe évasée offre un mouvement splendide pour toutes vos sorties estivales.',
                'rating' => 4.9,
                'reviews_count' => 19,
                'is_popular' => true,
                'is_new' => false,
                'stock' => 9,
            ]),
            new static([
                'id' => 8,
                'name' => 'Robe décontractée',
                'slug' => 'robe-decontractee',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product8.jpeg',
                'category' => 'Robes',
                'description' => 'Robe ample et ultra-légère conçue pour le confort des journées ensoleillées. Style minimaliste moderne.',
                'rating' => 4.6,
                'reviews_count' => 25,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 15,
            ]),
            new static([
                'id' => 9,
                'name' => 'Boubou fleuri décoré',
                'slug' => 'boubou-fleuri-decore',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product9.jpeg',
                'category' => 'Boubous',
                'description' => 'Boubou traditionnel orné de superbes motifs fleuris brodés à la main. Un vêtement d\'exception pour vos cérémonies et grands événements.',
                'rating' => 5.0,
                'reviews_count' => 8,
                'is_popular' => false,
                'is_new' => true,
                'stock' => 3,
            ]),
            new static([
                'id' => 10,
                'name' => 'Boubou lumineux',
                'slug' => 'boubou-lumineux',
                'price' => 15000,
                'original_price' => 20000,
                'image' => 'product10.jpeg',
                'category' => 'Boubous',
                'description' => 'Boubou aux teintes éclatantes qui reflètent superbement la lumière. Finition soignée au niveau de l\'encolure pour un look haut de gamme.',
                'rating' => 4.7,
                'reviews_count' => 12,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 6,
            ]),
            new static([
                'id' => 11,
                'name' => 'Salopette évasée',
                'slug' => 'salopette-evasee',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product11.jpeg',
                'category' => 'Ensembles',
                'description' => 'Salopette au design vintage rétro revisité. Jambes évasées fluides apportant une touche chic et décontractée originale.',
                'rating' => 4.4,
                'reviews_count' => 7,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 5,
            ]),
            new static([
                'id' => 12,
                'name' => 'Boubou ample chic',
                'slug' => 'boubou-ample-chic',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product12.jpeg',
                'category' => 'Boubous',
                'description' => 'Le juste équilibre entre style traditionnel et élégance urbaine moderne. Tissu haut de gamme très doux sur la peau.',
                'rating' => 4.9,
                'reviews_count' => 16,
                'is_popular' => false,
                'is_new' => true,
                'stock' => 7,
            ]),
            new static([
                'id' => 13,
                'name' => 'Boubou ample décontracté',
                'slug' => 'boubou-ample-decontracte',
                'price' => 15000,
                'original_price' => null,
                'image' => 'product13.jpeg',
                'category' => 'Boubous',
                'description' => 'Coupe extra-ample assurant une liberté de mouvement totale. Idéal pour se détendre tout en restant raffiné.',
                'rating' => 4.8,
                'reviews_count' => 11,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 10,
            ]),
            new static([
                'id' => 14,
                'name' => 'Gilet contemporain premium',
                'slug' => 'gilet-contemporain-premium',
                'price' => 8000,
                'original_price' => 10000,
                'image' => 'product14.jpeg',
                'category' => 'Gilets',
                'description' => 'Version premium de notre gilet contemporain avec doublure soyeuse et poches intérieures discrètes.',
                'rating' => 4.9,
                'reviews_count' => 21,
                'is_popular' => false,
                'is_new' => false,
                'stock' => 4,
            ]),
        ]);
    }
}
