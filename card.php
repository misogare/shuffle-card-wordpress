<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mesvak.software
 * @since             1.0.0
 * @package           Card
 *
 * @wordpress-plugin
 * Plugin Name:       shuffle card
 * Plugin URI:        https://mesvak.software
 * Description:       this is a shuffle card for reading people's mind and helping them through their problems 
 * Version:           1.0.0
 * Author:            mesvak
 * Author URI:        https://mesvak.software/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       card
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CARD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-card-activator.php
 */
function activate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-activator.php';
	Card_Activator::activate();
	global $wpdb;
$wpdb->set_charset($wpdb->dbh, 'utf8mb4');

    $table_name = $wpdb->prefix . 'cards';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        icon varchar(255) NOT NULL,
        description text,
        ldescription text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
    $error = $wpdb->last_error;

if (!empty($error)) {
    error_log("Database error: $error");
}

	$cards = array(
        array('name' => 'Card 1', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-00-The-Fool.jpg', 'description' => 'Life is trial and error; one has to learn through errors.','ldescription' => "The Fool represents life as trial and error, learning through mistakes. A fool's simplicity offers insight beyond conventional wisdom. There are three types of fools: the simple, the complex, and the blessed. Every child starts as a simple fool, ignorant but happy. As they gain knowledge, they become complex fools, burdened by intellect. The blessed fool transcends knowledge, returning to a childlike state of pure awareness. They understand that knowledge is a barrier to true knowing and embrace clarity of vision. This journey symbolizes growth from ignorance to enlightenment."),
        array('name' => 'Card 2', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-01-Existence.jpg', 'description' => 'We are part of existence, we are not separate. Even if we want to be separate, we cannot be … . And the more you are together with existence, the more alive you are.','ldescription' =>"Embrace unity with existence, for separation is illusionary. Living fully connects you with existence, renewing you with each breath and heartbeat. Recognize the constant flow of life from existence, fostering trust and eliminating the need for external saviors. Rejoice in the divine intelligence and consciousness inherent in the universe. Open yourself to participation in the cosmic dance of existence."),
        array('name' => 'Card 3', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-02-Inner Voice.jpg', 'description' => 'We unnecessarily go on seeking advice from the outside when existence is ready to speak to us from the innermost core of our being. It is already there, but we never listen to that still, small voice.','ldescription' =>"Seek wisdom from within rather than outside sources. The inner self communicates silently, without words. Silence the mind to hear its guidance clearly. Like hearing the heartbeat in absolute silence, meditation unveils the inner guide. Once found, live spontaneously, responding authentically to life. Reactions stem from the mind, while responses arise from the core, leading to harmony with existence. Trust the inner voice to navigate life's journey."),
        array('name' => 'Card 4', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-03-Creativity.jpg', 'description' => 'Creativity happens only when ego is absent, when you are relaxed, in deep rest, when there is really no desire to do something. Suddenly you are gripped; some unknown force overwhelms you, takes possession of you.','ldescription' =>"True creativity arises in egoless moments of deep rest, where desire to create dissipates. In these rare instances, an unknown force takes over, leading to a state of possession. Creativity merges with existence, dissolving the creator's ego. Poets, painters, and creators recognize these moments only in hindsight, while meditators grasp them in the present. Awareness of egolessness unveils a new dimension of being, akin to nirvana. Meditation aims to capture these moments, completing the journey when creativity and meditation converge."),
        array('name' => 'Card 5', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-04-The-Rebel.jpg', 'description' => 'The situation of the rebel is tremendously exciting: each moment he is faced with problems because the society has a fixed mode, a fixed pattern, fixed ideals. And the rebel cannot go with those fixed ideals—he has to follow his own still, small voice.','ldescription' =>"The rebel embraces excitement amidst societal norms, following their inner voice. Renouncing the past, they bring novelty to the world, distinguishing themselves from escapists. Freedom and responsibility intertwine; true freedom entails accepting responsibilities. Understanding responsibility as response and ability, rebels act with consciousness, not duty. They respond freshly to each moment, breaking free from past conditioning. This ability marks the rebel's path."),
        array('name' => 'Card 6', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-05-No-Thingness.jpg', 'description' => 'To create nothingness in you is the goal of meditation, but this nothingness has nothing to do with the negative idea. It is full, It is so full that it starts overflowing. Buddha has defined this nothingness as overflowing compassion.abundantly full.','ldescription' =>"Meditation aims to cultivate a full, positive nothingness, overflowing with compassion. In Eastern tradition, nothingness isn't negative but a state of pure consciousness, devoid of content. This emptiness births infinite possibilities, unlike finite somethingness. God is seen as a creative void, shunya, formless yet capable of myriad manifestations. Meditation leads to this nothingness, freeing one from mental bondage. Thoughts are transient forms in the vast lake of consciousness; don't cling to them. Embrace the reality of consciousness, where thoughts arise and dissolve."),
        array('name' => 'Card 7', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-06-The-Lovers.jpg', 'description' => 'To others it will look like madness—in fact all love is mad and all love is blind, at least to those who don’t know what love is. To “unlovers” love is blind; to lovers, love is the only possible eye that can see to the very core of existence.','ldescription' =>"Love appears mad to those who don't understand its depth. It's the journey's goal, providing direction and richness to life. Intimacy, rooted in inner vulnerability, is rare today. True love transforms wounds into lotuses, but requires self-sufficiency. Only when you're content alone can you love authentically. Certainty in your own love precedes certainty in others'. Self-love is crucial; without it, doubts arise about others' love. Be certain of yourself, and you'll be certain of the world."),
        array('name' => 'Card 8', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-07-Awareness.jpg', 'description' => 'You are awareness. It is nothing you do, it is nothing that has to be done—your very nature is awareness.','ldescription' =>"You are pure awareness, beyond the mind's limitations. The mind is a tool, not your essence. By witnessing thoughts and actions, awareness deepens. Mind ceases its dominance, becoming a servant to your consciousness. Through vigilance, every moment becomes an opportunity for awakening. This process liberates you from identification with the mind, transforming base consciousness into pure gold. Awareness, like electricity, flows through the mind but is not confined by it. Through witnessing, you reclaim mastery over your being, transcending unconscious bondage to realize your true nature."),
        array('name' => 'Card 9', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-08-Courage.jpg', 'description' => 'Growth certainly needs one thing, and that is courage. That is the most fundamental religious quality. Everything else is ordinary and can follow, but courage is the most fundamental thing, the first thing.','ldescription' =>"Growth requires courage—the essence of spirituality. Like a seed, you face four possibilities: remaining closed, diving into the soil, blossoming into a flower, and releasing fragrance. Courage prompts the seed to sprout, risking vulnerability to commune with existence. The plant stage demands love and sharing, evolving into the flowering stage where beauty emerges through giving. Finally, fragrance symbolizes ultimate unity with existence. Don't linger as a seed—embrace courage, vulnerability, and love to bloom fully and share your essence with the world."),
        array('name' => 'Card 10', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-09-Aloneness.jpg', 'description' => 'There are a few things that can only be done alone. Love, prayer, life, death, aesthetic experiences, blissful moments—they all come when you are alone','ldescription' =>"Aloneness is a profound state where true experiences unfold—love, prayer, life, death. Fear of solitude drives many to conformity, losing individuality. Yet, being alone is a miracle, liberating from labels and ideologies. Birth and death are solitary, meditation a rebirth. Even in love, two souls remain distinct, sharing their unique aloneness. Alone, you're untouched, pure, and real. Love reveals the depth of your aloneness, reflecting it back. True experiences arise from within, where none can intrude. Aloneness isn't loneliness; it's the essence of authenticity and freedom."),
          array('name' => 'Card 11', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-10-Change.jpg', 'description' => 'Only the entry of the new can transform you, there is no other way of transformation. If you allow the new to enter, you will never be the same again.','ldescription' =>"Embrace the new, for it's the sole catalyst of transformation. Despite fear and uncertainty, openness to the unknown births growth and fulfillment. Courage is key; without it, stagnation prevails. The new, an eternal visitor, offers renewal, richness, and liberation. Reject it, and life remains mundane and closed-off. Only by welcoming the new can one unlock life's splendor. Repetition breeds robotic existence; to avoid a life of misery, embrace freshness, spontaneity, and continuous evolution. Love, too, thrives in novelty—each moment should unfold as a unique revelation."),
        array('name' => 'Card 12', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-11-Breakthrough.jpg', 'description' => 'In English we have two words, very beautiful, of great significance: one is breakdown, the other is breakthrough. Breakdown is when you don’t know any meditation and your logic becomes irrelevant. Then there is a breakthrough: you enter into a new world, a new vision, a new perspective.','ldescription' =>" Embrace breakdowns as opportunities for breakthroughs. When reason fails, shift focus to the heart. Instead of restoring the old structure, guide towards a new center of being—love. Like changing gears in a car, navigate through neutral states to reach the heart's energy. Initially, exhaustion signals a transition to deeper energy layers, where immense vitality awaits. Beyond individual and collective layers lies the cosmic, attainable through enlightenment. Each breakdown holds potential for heart-centered growth, leading to boundless energy and spiritual realization."),
        array('name' => 'Card 13', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-12-New-Vision.jpg', 'description' => 'Spirituality is not the practicing of any virtue; spirituality is the gaining of a new vision. Virtue follows that vision; it comes on its own accord. It is a natural by-product. When you start seeing, things start changing.','ldescription' =>"Spirituality isn't about practicing virtues but gaining a new vision. Virtues naturally follow this shift. Let go of the past burdens to embrace a fresh, present-focused life. Surrender the ego to experience dissolution and birth of a new vision. Awareness of the chaotic mind weakens its grip, paving the path to enlightenment. Transition from mind to no-mind brings peace and bliss, liberating from mental turmoil. Choose consciousness to transcend hellish states and embrace heavenly realms."),
        array('name' => 'Card 14', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-13-Transformation.jpg', 'description' => 'The art of transforming suffering, pain, evil, into something good is the art of seeing the necessity of the opposite. Only through that acceptance is transformation possible.','ldescription' =>"Transformation of suffering into good requires seeing the necessity of opposites: light needs darkness, life requires death. Accepting both as complementary allows for transformation. Witnessing suffering without identification enables absorption without pain. By understanding opposites as interchangeable, evil can be turned into good, like alchemy turning base metal into gold. To find true bliss, one must risk exploring new paths, for the old has proven meaningless. Change begins externally, strengthening the courage for internal transformation. Bliss may not depend on the path, but on the traveler, yet embarking on a new path is a hopeful start."),
        array('name' => 'Card 15', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-14-Integration.jpg', 'description' => 'At your very center you are integrated, otherwise you could not exist at all. How can you exist without a center?','ldescription' =>"At your core, you're integrated; existence requires a center. Efforts to 'become' disrupt integration; it's innate. Relax the periphery, turn inward, and discover the existing unity. Through insight, allow the center to surface effortlessly. An ancient Tibetan meditation suggests briefly disappearing to realize the world continues without you. Embrace receptivity; become a passive observer. Integration isn't achieved but discovered within, where fragmentation ends, revealing absolute unity."),
        array('name' => 'Card 16', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-15-Conditioning.jpg', 'description' => 'Whatever you have learned from others is not you. That is your persona, and you have to find your innocence again.You have to find your essence before people started putting layers on you, before people started civilizing you.','ldescription' =>"Your essence is buried beneath societal layers; find your innocence anew. An Eastern parable tells of a lion raised as a sheep. Oblivious to its true nature, it lived among the sheep, adopting their ways. Upon discovery by an old lion, a reflection revealed its lionhood, igniting a roar of realization. Similarly, personality, shaped by societal opinions, veils true individuality. Children are born authentic but adopt personas over time. Meditation aims to shed this persona, reconnecting with innate essence, obscured by societal conditioning. Recognize the difference between learned persona and innate individuality."),
        array('name' => 'Card 17', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-16-Thunderbolt.jpg', 'description' => 'Man forgets many things intentionally. He tries not to remember, because remembering may smash all his ego and bring it all crashing down. But in this life, we get as much as we are willing to give up and let go.','ldescription' =>"Man often forgets intentionally to preserve his ego. Life offers only what we're willing to relinquish. Truth can shock, awakening us abruptly like from a deep sleep, leaving us momentarily disoriented. True awakening leaves us speechless, calm, and silent. Hold this insight like a jewel. Just as air escapes a clenched fist but fills an open hand, renunciation brings abundance. Clinging leads to loss, while letting go allows life's riches to flow in. Holding onto possessions is folly; true wealth lies in releasing attachments."),
        array('name' => 'Card 18', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-17-Silence.jpg', 'description' => 'When you go in, you touch a new kind of silence—the presence of silence itself. It is not only an absence of noise, it is something absolutely positive, almost visible, tangible.','ldescription' =>"Inner silence surpasses outer tranquility. While forests offer peace, true silence lies within. It's not just the absence of noise but a tangible presence. Many fear silence as it dissolves the ego, plunging them into the unknown. Yet, embracing silence leads to authenticity and connection with the divine. Those who love silence embrace existence and truth, uncovering inner scriptures and sermons. Sannyas, true renunciation, is a profound love for silence—an immersion into the depths of being."),
        array('name' => 'Card 19', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-18-Past-Lives.jpg', 'description' => 'One dream comes, is followed by another dream, and is followed by yet another dream. The pilgrim starts from one moment and enters into the next one. Moment after moment, the moments keep disappearing, but the pilgrim continues moving on.','ldescription' =>"Life is a continuum of dreams, each moment leading to the next. Explore the hypothesis of reincarnation without bias. Investigate your past lives as a path to understanding. Buddha coined the term 'storehouse of consciousness' to describe the accumulation of memories across lifetimes. Delve into the question 'Who am I?' to unravel the depths of existence beyond birth and death."),
        array('name' => 'Card 20', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-19-Innocence.jpg', 'description' => 'If you really want to know, you will have to drop all your knowledge; you will have to unlearn it. You will have to become ignorant again, like a small child with wondering eyes, with alertness.','ldescription' =>"True wisdom lies not in accumulated knowledge but in childlike innocence. Buddha, Jesus, and Mohammed were not learned scholars but innocent souls who penetrated their innermost beings through watchfulness. Reclaim your inherent innocence obscured by societal conditioning. Cleanse the layers of dust covering your inner mirror to rediscover your true nature. Drop borrowed knowledge and embark on a journey of self-discovery through negating external influences. Innocence is the gateway to knowing; shed the burden of acquired knowledge to become like a child again."),
          array('name' => 'Card 21', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-20-Beyond-Illusion.jpg', 'description' => 'It takes a little effort to get out of illusions because we have invested in them very much. They are our hopes: It is through them that we go on living.','ldescription' =>"To break free from illusions, abandon invested hopes and live fully in the present. Meditation liberates from the mind's illusions, anchoring in the moment's reality. It's challenging as we've habituated to illusions, clinging to future expectations. Yet, true joy blossoms in present awareness, devoid of past regrets or future worries. Analyzing illusions, like psychoanalysis does, only deepens the entanglement. Illusions lack roots; searching for their cause leads nowhere. Awareness dissolves illusions, birthing a new consciousness. Surrendering to the present moment unveils profound clarity, transcending the mind's illusions."),
        array('name' => 'Card 22', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-21-Completion.jpg', 'description' => 'Remember one basic law: anything that is complete drops, because then there is no meaning in carrying it; anything that is incomplete clings, it waits for its completion. And this existence is really always longing for completion.','ldescription' =>"Existence yearns for completion. Incomplete living burdens the mind, fueling an incessant internal monologue. Break this cycle by completing each action fully. Engage with total presence in every task. Anger? Express it authentically, then let it go. Living wholly in the moment dissolves the monologue, ushering in silence. Embrace each moment as if it's the last, completing actions without haste. Only through complete living can the mind find peace amidst life's chaos."),
        array('name' => 'Card 23', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-22-The-Master.jpg', 'description' => 'Once you have seen a buddha, an enlightened one, a tremendous flame suddenly starts blossoming in you. “If this beauty, this grace, this wisdom, this blissfulness can happen to any man, then why can it not happen to me?”','ldescription' =>"Encountering a true master ignites a flame within, challenging you to realize your potential. Authentic masters provoke inner exploration, leading to silence and freedom. Beware of false teachers; true masters emanate grace and energy, guiding you to unlock your treasures. They embody your future potential, inspiring the journey from seed to flower. Without realizing this potential, true bliss remains elusive. Embrace the master's invitation for inner transformation, for each person holds the capacity to become divine."),
        array('name' => 'Card 24', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-01-Going-With-The-Flow.jpg', 'description' => 'Trust means you are not fighting; surrender means you don’t think of life as the enemy but as the friend. Once you trust the river, suddenly you start enjoying.','ldescription' =>"Trust and surrender transform life's challenges into joyful experiences. Like swimming in a river, trust means not fighting but merging with the flow. Surrender sees life as a friend, not an enemy. Just as water conquers obstacles effortlessly, surrendering to life's currents brings peace. Embrace the feminine energy, flowing like water, adaptable and powerful without aggression."),
        array('name' => 'Card 25', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-02-Friendliness.jpg', 'description' => 'Rather than creating friendship, create friendliness. Let it become a quality of your being, a climate that surrounds you, so you are friendly with whomsoever you come in contact.','ldescription' =>"Create friendliness as a quality of your being, transcending the idea of using others. Friendship is the highest form of love, devoid of greed. Share joy without expectation, fostering gratitude for those who accept your love. Expand love beyond limitations, embracing existence with friendliness. Love abundantly without addressing anyone in particular; your love enriches as it spreads. In consciousness, love becomes intrinsic to your being, radiating to all who can receive it. Love not for reasons, but out of abundance, gratefully embracing every recipient."),
        array('name' => 'Card 26', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-03-Celebration.jpg', 'description' => 'Celebration is a thankfulness; it is prayer out of gratitude. It is recognition of the gift that has been given to us …','ldescription' =>"Celebration is gratitude in action, recognizing life's immense gift. Despite abundance, ingratitude prevails, robbing life of its joy. Animals play; only humans celebrate, a privilege of recognizing existence's blessings. To celebrate, embrace ordinary moments, rejecting conditional barriers. Bertrand Russell envied primitives' spontaneous celebrations, untainted by conditions. Man's ego demands fulfillment; life just requires presence. You're extraordinary in your ordinariness; celebrate now. Celebrating enhances life force; ego imposes hurdles. Birds sing without training; man's nature is to celebrate. Celebrate and become the Buddha, the Jesus, the Mohammed within. Life should be a continuous dance of wonder, embracing each moment's surprise."),
        array('name' => 'Card 27', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-04-Turning-In.jpg', 'description' => 'Meditation is the whole art of transforming the gestalt. The consciousness that goes outward starts turning in. And then one becomes aware of millions of gifts; then small things, very small and ordinary things have tremendous significance.','ldescription' =>"Meditation shifts focus inward, unveiling profound significance in ordinary moments. Seeking answers externally brings no fulfillment; the kingdom of God lies within. Turning inward isn't a physical journey but a cessation of outward pursuit. It's realizing desires lead to misery and embracing stillness. In this stillness, one awakens to their innate buddhahood. Hakuin's wisdom echoes: all beings are inherently enlightened."),
        array('name' => 'Card 28', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-05-Clinging-To-The-Past.jpg', 'description' => 'A person who lives in the present—neither bothering about the past nor bothering about the future—is fresh, young; he is neither a child nor an old man. And one can remain young to the very last breath.','ldescription' =>"Living in the present, unburdened by the past or future, keeps one youthful. Past attachments hinder present joy and future possibilities. Time is still; past, present, and future are constructs of the mind. Letting go brings clarity and peace. Witnessing without clinging is meditation, freeing one from anguish and turmoil."),
        array('name' => 'Card 29', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-06-The-Dream.jpg', 'description' => 'Deep down there are dreams and dreams and dreams. An undercurrent of dreaming goes on—and that undercurrent goes on corrupting our vision.','ldescription' =>"Dreaming corrupts perception, projecting desires onto reality. The dreamer becomes disillusioned when reality clashes with fantasy. Those continuously dreaming about success find frustration upon attainment. To awaken, recognize the dreamlike nature of existence. Contemplate everything as a dream, including the self. Through awareness, the ego dissolves, revealing a new quality of consciousness. In dreamless sleep, awake within the dream, experiencing reality with newfound clarity."),
        array('name' => 'Card 30', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-07-Projections.jpg', 'description' => 'You never look at things as they are; you mix them with your illusions.And you are so afraid to look straight because you know, unconsciously, deep down somewhere, you know that things are not as you see them.','ldescription' =>"Perception is distorted by illusions; avoiding reality, you coat it with dreams. Love and hate change how you see, but it's your projection. To know truth, silence the mind's interpretation. Start by observing neutrally, detaching from emotional involvement. Just look, without judgment or words. Initially challenging, like learning to swim, but with practice, light replaces dreaming. By bypassing the mind, truth illuminates, freeing you from illusions."),
          array('name' => 'Card 31', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-08-Letting-Go.jpg', 'description' => 'When the ocean has called you, trust it—take a jump and disappear into it.','ldescription' =>"Trust in the call of the ocean, surrender to faith, and let go of fear. Strong surrender stems from self-trust and a thirst for exploration. The courageous embrace danger, seeing it as their shelter. Effort cannot attain sublime truths; they come as grace, received through readiness and expectancy, not striving. Waiting with anticipation, without expectations, allows the universe to unfold its gifts. Surrender, trust, and openness unveil life's mysteries, offering profound insights beyond effort."),
        array('name' => 'Card 32', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-09-Laziness.jpg', 'description' => 'One should be overflowing with energy. One should be at ease, but not lazy. One should be relaxed, but not lazy.','ldescription' =>"Embrace boundless energy, avoiding the trap of laziness. Laziness, rooted in the mind, resists change and clings to familiarity. Despite its allure, it fosters guilt and stagnation. True ease, however, exudes vitality and relaxation, free from tension and hurry. Like vibrant trees, life flourishes when approached with effortless grace, not laziness."),
        array('name' => 'Card 33', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-10-Harmony.jpg', 'description' => 'You are just in the middle between death and life—you are neither. So don’t cling to life and don’t be afraid of death.','ldescription' =>"Embrace the hidden harmony between opposites, like life and death. Just as a river finds its way to the ocean through diverse paths, seek unity amid contradictions. Society values consistency, but true wisdom lies in navigating through opposites. Love your enemies, for they hold the key to deeper love. Death and life are not separate; you exist in the harmony between them. Don't choose sides; be the harmony itself, transcending attachment and fear."),
        array('name' => 'Card 34', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-11-Understanding.jpg', 'description' => 'In your very understanding you are free.','ldescription' =>"Understanding leads to freedom. Accumulating information doesn't equate to true knowledge; it's merely words. Scholars amass words like rats devouring film, missing the essence. True knowing lies in experiencing. In the heart, knowledge is action; understanding translates directly into doing. The heart's intelligence acts intuitively, without needing to question 'how.' Nourish the seed of understanding within; it has the power to bloom into profound transformation."),
        array('name' => 'Card 35', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-12-Trust.jpg', 'description' => 'Trust is yes. Knowing that this existence is our mother, that nature is our source and it can’t be against us, it can’t be inimical to us. Seeing this, understanding this, trust arises.','ldescription' =>"Trust in the benevolence of existence, akin to a mother, nurtures faith. Despite doubt, take the leap, for doubt breeds doubt while trust fosters trust. Start with doubt but prioritize trust; attention feeds doubt but starves trust. Trust amidst doubt dismantles skepticism's chain, leading to clarity."),
        array('name' => 'Card 36', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-13-Receptivity.jpg', 'description' => 'One has to become feminine. One has to become receptive rather than being aggressive. One has to learn the art of relaxation rather than learning the strategies of how to conquer the world.','ldescription' =>"Embrace receptivity over aggression, relaxation over conquest. Receptivity is a welcoming, a prayer; it hosts and nurtures like a womb. Inactivity breeds indifference, but true detachment is engaged yet unattached. Energy, when pooled, undergoes transformative growth. Positive femininity isn't lethargy but a reservoir of vibrant energy, evolving through qualitative shifts."),
        array('name' => 'Card 37', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-14-Healing.jpg', 'description' => 'Be aware of your wound. Don’t help it to grow, let it be healed; and it will be healed only when you move to the roots. Go to the roots. Be with the whole.','ldescription' =>"Be aware of your wounds and let them heal by addressing their roots. Misery should be rare; happiness should be the norm. Therapy stems from love; see patients as learners, not problems. Healing and wholeness are intertwined; meditation and medicine share the same root. To be healed is to be whole, to be holy—not bound to religion, but complete within, fulfilling existence's purpose."),
        array('name' => 'Card 38', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-01-Consciousness.jpg', 'description' => 'If you understand it, the world is a great device to make you more conscious. Your enemy is your friend, and the curses are blessings, and the misfortunes can be turned into fortunes. It depends only on one thing: if you know the key of awareness.','ldescription' =>"Understanding life's challenges fosters consciousness. Adversities serve as opportunities for awakening. Meditation isn't limited to isolated sessions; it's a continuous state of awareness in daily activities. Consciously eating, walking, and even sleeping enhances life's quality. Awareness transforms mundane actions into mindful experiences, fostering contentment and joy. Meditation permeates every moment, enriching existence with profound insight and inner peace."),
        array('name' => 'Card 39', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-02-Schizophrenia.jpg', 'description' => 'Schizophrenia is not a disease that happens to a few people—it is the normal state of humanity. Everybody is divided, split.','ldescription' =>"Schizophrenia isn't a rarity—it's humanity's norm. Like a mouse torn between two boxes, we're torn between conflicting desires. Unsure of our choices, we compromise, but find no fulfillment. Life's dilemma: pursue love or seek spirituality? We oscillate, never at peace. Society's conflicting teachings breed our inner division. To transcend, we must grasp the dilemma's essence. Understanding, not solutions, liberates. We're products of a schizophrenic world, molded by contradictory ideologies. Recognizing this, we can reconcile our divided selves and find unity amidst chaos."),
        array('name' => 'Card 40', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-03-Ice-Olation.jpg', 'description' => 'You have to dissolve the ego, not to isolate it … . If you want to renounce anything, renounce yourself.','ldescription' =>"Dissolve the ego, not isolate it. Renounce yourself, not the world. Understand dependence as interdependence; you are part of the whole. Escape from the illusion of independence; you are inseparable from existence, like a wave in the ocean. Life's oneness is interdependence, akin to love or god. Don't isolate; embrace the world's beauty. The problem lies within, not in the world. Drop your misconceptions, not the world around you."),
          array('name' => 'Card 41', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-04-Postponement.jpg', 'description' => 'Always think of each moment as the last, as if there is going to be no tomorrow at all. Then what will you do?','ldescription' =>"Live each moment as if it's your last. Don't postpone bliss. A story illustrates embracing joy despite impending doom. Cultivate constant awareness of death's certainty to transform values and priorities."),
        array('name' => 'Card 42', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-05-Comparison.jpg', 'description' => 'When you compare, you miss; then you will always be looking at others. And no two persons are the same, they cannot be. Every individual is unique and every individual is superior, but this superiority is not comparable.','ldescription' =>"Comparing breeds inferiority; uniqueness eliminates it. A Zen master's tale illustrates accepting natural differences without comparison. Your soul's superiority lies in non-comparison. Recognize your intrinsic uniqueness; comparing is futile. Life's myriad facets defy comparison; uniqueness emerges from self-awareness, fostering joy. Learn from all, but imitation stifles growth. Embrace your essence to learn from diverse sources without imitation."),
        array('name' => 'Card 43', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-06-The-Burden.jpg', 'description' => 'Life is a constant resurrection. Every moment it dies, every moment it is born anew. But you go on carrying the old mind; you will never fit anywhere.','ldescription' =>"Life is perpetual renewal, but the mind clings to the past, creating discord. Life flows, the mind stagnates. Embrace a mindless state to align with life's fluidity. The mind's fixation hinders harmony; only by shedding it can you merge with life's rhythm. Existence unfolds in the present, yet the mind fixates on the past, breeding discord. Adapt a formless consciousness to harmonize with life's ever-changing dance."),
        array('name' => 'Card 44', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-07-Politics.jpg', 'description' => 'Our culture, our education, our religion—they all teach us to be hypocrites in such subtle ways that unless you go deep in search, you will never find out what you have been doing.','ldescription' =>"Society molds us into hypocrites subtly, embedding false politeness and strategies. We smile to appease, greet to disarm. Authority attracts corrupted individuals, who exploit power for personal gain. Those once humble transform when empowered. Abuse of authority perpetuates, from office to home, creating a cycle of domination. Awareness prevents abuse, fostering tranquility and genuine interactions. Uncover societal layers, detach from false norms, and embrace authenticity."),
        array('name' => 'Card 45', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-08-Guilt.jpg', 'description' => 'The word guilt should never be used. The very word has wrong associations; and once you use it you are caught in it.','ldescription' =>"Reject the notion of guilt imposed by society and religion. Guilt is a tool to control and manipulate individuals. Mistakes are human, not sins. Realize your innate perfection and reject imposed ideals. However, acknowledge a meaningful guilt arising from a lack of personal growth or fulfillment of potential. This self-awareness motivates positive change and aligns with spiritual growth, distinct from societal guilt. Embrace responsibility for personal development without succumbing to external pressures or false ideologies."),
        array('name' => 'Card 46', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-09-Sorrow.jpg', 'description' => 'Bliss has not to be found outside, against sorrow. Bliss has to be found deep, hidden behind the sorrow itself. You have to dig into your sorrowful states and you will find a wellspring of joy.','ldescription' =>"Dive into your sorrow instead of avoiding it. Without judgment, explore its depths. As you delve deeper, sorrow dissipates, revealing underlying joy. Understand the two types of sadness: temporary, caused by loss, and existential, inherent in life's meaninglessness. Existential sorrow arises from disillusionment with worldly pursuits, signaling a readiness for inner transformation. When external hopes fail, embrace the journey inward, propelled by utter disillusionment. This inner exploration marks the beginning of profound change."),
        array('name' => 'Card 47', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-10-Rebirth.jpg', 'description' => 'The real sage again becomes a child. The circle is complete—from the child back to the child. But the difference is great …. The first birth is of the body and the second birth is of the consciousness.','ldescription' =>"The evolution of consciousness, symbolized by the camel, lion, and child, represents a journey from slavery to freedom to innocence. The camel, obedient and enslaved, transforms into the lion, rebellious and free, then into the child, innocent and trusting. Pride, not ego, drives this transformation. The child's sacred yes emerges from trust, not fear. Saying yes without the ability to say no lacks meaning. True transformation requires embracing both the sacred no and the sacred yes, leading to a state of innocence and wonder."),
        array('name' => 'Card 48', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-11-Mind.jpg', 'description' => 'Don’t be cunning and calculating. Don’t try to be clever; the more clever you are, the more miserable you will be. This existence can be contacted only in innocence, childlike innocence.','ldescription' =>"Reject cunningness and calculation; existence reveals itself through innocence. Jesus advocated childlike innocence over cleverness. Knowledge is borrowed and closes the heart to existence. Stubbornness arises from clinging to borrowed knowledge. Understanding leads to realizing one's ignorance. Spiritual perception arises from dropping principles and unnecessary mental baggage. Observe the clutter in your mind; its presence obstructs reality. Decide to drop the mental cloud; it dissipates with your intention."),
        array('name' => 'Card 49', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-12-Fighting.jpg', 'description' => 'In the fight you can create the notion of the ego; in the challenge, in resistance, you can create the notion of the ego. If you drop fighting and you float with the stream, by and by you will come to know that you do not exist separate from the whole.','ldescription' =>"Fighting creates the ego. Instead, flow with existence; you're not separate from the whole. Fighting maintains the ego, needing constant validation. Let go of compulsions; let existence act through you. Success and failure both lead to misery. True satisfaction lies in knowing your being, not in external achievements. Drop the ego, become a conduit for existence. Learn to stand aside and let things happen naturally. You're part of the whole; just participate without creating conflict."),
        array('name' => 'Card 50', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-13-Morality.jpg', 'description' => 'There is no higher law than love, so love is the true foundation of morality—not codes, not commandments.','ldescription' =>"Love, not codes, is the foundation of true morality. Moralists condemn, driven by superiority, while saints forgive and understand human limitations. Society molds conscience, creating inner conflict for immoral actions. Fearful of losing respect and inner turmoil, cowards adopt morality. Real morality arises from consciousness, not society's dictates. The awakened follow their own light, risking societal disapproval. True religion stems from consciousness, fostering spontaneous, intelligent morality, not fear-based obedience."),
          array('name' => 'Card 51', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-14-Control.jpg', 'description' => 'In controlling yourself you miss the whole point of being alive, because you miss celebration. How can you celebrate if you are too controlled?','ldescription' =>"Don't force yourself to conform to ideals like patience or love; true freedom isn't about control or license. Repression leads to inner conflict and hypocrisy. Instead, embrace awareness—freedom arises naturally from authenticity. It's neither control nor license but a balanced state where celebration thrives. Awareness dissolves the need for control or license, fostering genuine freedom and spontaneity in life."),
        array('name' => 'Card 52', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-01-The-Source.jpg', 'description' => 'When the energy is just there—not going anywhere, just pulsating at the original source, just radiating its light there, blossoming like a lotus, neither going out nor going in—it is simply here and now.','ldescription' =>"Zazen, or Zen meditation, is about tapping into the source of energy within, rather than solely residing in the intellect. Education often confines energy to the head, hindering awareness of one's true essence. Zazen encourages sitting at the source of energy, allowing it to blossom into love, creativity, and compassion. This inner luminosity is inherent to every individual, not external. By turning inward, one discovers their innate light, becoming self-aware and radiant from within."),
        array('name' => 'Card 53', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-02-Possibilities.jpg', 'description' => 'To live means to live dangerously; to live means to remain available to all possibilities. And infinite are the possibilities. You are not limited to any possibility, you have an unlimited being, unbounded. You can be anything; the next moment can bring anything.','ldescription' =>"Living dangerously means embracing the infinite possibilities of existence without clinging to security. Each individual embodies the entirety of humanity and nature, capable of endless transformations. Like a river, life's unpredictability is its essence. Nature offers myriad choices, whether to rise or fall, and cooperation regardless of the path chosen. Suffering and happiness, blindness and awareness—all are natural expressions. Consciousness deepens choice, leading to either happiness or misery. Just as water transforms naturally, humans navigate life's choices, evolving in consciousness towards happiness or stagnating in unconsciousness towards misery."),
        array('name' => 'Card 54', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-03-Experiencing.jpg', 'description' => 'Sitting by a flower, don’t be a man or a woman, be a flower. Sitting by a tree, don’t be a man or a woman, be a tree. Taking a bath in a river, don’t be a person, be a river. And then millions of signs are given to you.','ldescription' =>"Merge with nature's language by shedding the confines of thought. Be a flower, a tree, a river—immerse without interpretation. Listening without mental interference allows communion with existence. Nature speaks wordlessly through countless signs, a language of unity. To understand, be wordless, receptive. Existence transcends linguistic barriers; it's an internal dialogue. Don't analyze, but embrace the infinite dialogue within. Nature's wisdom unfolds when you dissolve into its essence."),
        array('name' => 'Card 55', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-04-Participation.jpg', 'description' => 'Jump into the river, that is the only way to know life. Jump into the river. Never be a spectator. The spectator is the poorest person in the world.','ldescription' =>"Participate in life's dance; don't just watch from the sidelines. Modern society breeds passive spectators, missing life's essence. Experience the dance by dancing, the song by singing. Sitting idle, watching others live, leaves one impoverished. Dive into life's river, feel its flow, its joy. God won't ask about deeds but whether life was celebrated. Don't be a stranger to existence; join the celebration, sing with the birds, bloom with the flowers. Be a participant, not a bystander."),
        array('name' => 'Card 56', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-05-Totality.jpg', 'description' => 'Always do whatever you want to do, but do it totally. If it is good it will become part of you. If it is not good, you will come out of it. That is the beauty of being total … that is the secret of being total.','ldescription' =>"Do everything with totality. Whether virtuous or not, immerse yourself completely. A Buddha doesn't repent; each action is done wholly. Incomplete actions lead to guilt and regret. Totality allows for total detachment afterward. Remember: total involvement allows for total disengagement. A person of awareness lives in the present, without clinging to the past or anticipating the future. Totality in action brings freedom from remorse and projection."),
        array('name' => 'Card 57', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-06-Success.jpg', 'description' => 'Just go on moving, enjoying whatsoever becomes available. If success is there, enjoy it. If failure is there, enjoy it—because failure brings a few enjoyments that no success can ever bring. Success also brings a few joys that no failure can ever bring.','ldescription' =>"Embrace life without chasing success or fleeing failure. Success or failure, both bring unique joys. Seeking success breeds discontent; failure often follows in a competitive world. Even spiritual quests can trap in desires for success. Instead, be choiceless, welcoming whatever life brings. Without preferences, enjoy every experience fully—be it health or illness. Misery stems from choice; bliss arises from acceptance. Live like a driftwood, flowing with life's currents, neither for nor against anything. Total acceptance is the path to true contentment, where every moment holds its own beauty."),
        array('name' => 'Card 58', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-07-Stress.jpg', 'description' => 'Struggling with life does not help at all. Struggling is simply destructive; there is no point in it. Effort is not needed.','ldescription' =>"Struggling in life is futile. The universe's goal contradicts personal aspirations. Embrace the essential, realizing unity with existence. Effortless acceptance brings inner peace. Success often masks inner emptiness, revealing the futility of material pursuits. Private goals lead to madness; relinquish them to discover the essential realm. Acceptance fosters gratitude and understanding, unveiling the beauty in all experiences. Amid pain, discern deeper meanings. Attaining the essential center allows dancing through life's varied circumstances, finding messages in every moment."),
        array('name' => 'Card 59', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-08-Traveling.jpg', 'description' => 'Life is a continuity, always and always. There is no final destination it is going towards. Just the pilgrimage, just the journey in itself is life, not reaching to some point, no goal.','ldescription' =>"Life is an endless journey with no final destination. Seeking a goal leads to disappointment. Even if one reaches it, there's emptiness. Rabindranath Tagore's tale illustrates this: searching endlessly for God, only to realize meeting Him yields nothing. Similarly, Ikkyu highlights life's joyous essence lies in the journey itself, not in reaching an end. Embrace the pilgrimage without fixating on destinations. Life is a fleeting celebration between nothingness. Enjoy the journey; there's no one to reach or nowhere to go. The traveler is a myth; the pilgrimage is real."),
        array('name' => 'Card 60', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-09-Exhaustion.jpg', 'description' => 'You are not to do anything to be happy. In fact you have done too much to become unhappy. If you want to be unhappy, do too much. If you want to be happy, allow things, allow things to be. Rest, relax, and be in a let-go.','ldescription' =>"To be happy, let go of striving. Allow life to unfold naturally. When you release control, you become aware of the beauty around you: birds singing, trees blossoming, rivers flowing. Stop postponing happiness for the future; life is already here. Inactivity and hyperactivity both hinder fulfillment. Balance action with rest, engaging with the world while remaining centered. Be like the lotus in the pond: active on the surface, serene at the core. Don't escape the world; engage in it while maintaining inner peace."),
          array('name' => 'Card 61', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-10-Supression.jpg', 'description' => 'Into the unconscious you go on throwing all the rubbish that society rejects—but remember, whatsoever you throw in there becomes more and more part of you: it goes into your hands, into your bones, into your blood, into your heartbeat.','ldescription' =>"Suppressing emotions splits the mind, leading to unconscious turmoil. Society teaches control, not transformation, breeding illness. Express emotions constructively, without projecting onto others. Catharsis cleanses like vomiting; anger is mental vomit. Beat a pillow, jog, or express anger non-destructively. Suppressing dulls life; awareness brings transformation. Society fails to teach watchfulness; openness allows expression. Control comes at the cost of vitality; awareness leads to spontaneous transformation."),
        array('name' => 'Card 62', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-11-Playfulness.jpg', 'description' => 'Play is something in which a goal is not at all involved. The very being together is beautiful—for the sheer joy of it! In a better world, with more understanding, games will disappear; there will only be play.','ldescription' =>"Playfulness is about being together for the joy of it, without goals. In a world of understanding, games vanish, leaving only pure play. There's no roadmap to playfulness; it's about being present without striving. Seriousness taints play, turning it into competitive games. Violence in sports reflects humanity's immaturity. In a better world, play won't involve winners or losers—just togetherness. Enjoy activities for their own sake, without obsessing over outcomes. Play is about the sheer energy and moment, not results."),
        array('name' => 'Card 63', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-12-Intensity.jpg', 'description' => 'If you live totally, intensely, then you are free, you have lived the moment and it is finished. You don’t look back and you don’t look ahead, you simply remain here now.','ldescription' =>"Living with total intensity allows one to transcend the self and dissolve into the moment. When completely immersed in an experience, the self vanishes, leaving only the experience itself. Total involvement, whether in love, anger, or appreciation of beauty, leads to a state of oneness with the observed. Children exemplify this intensity, expressing emotions fully and without reservation. Unlike adults, they don't accumulate psychological memory because their experiences are lived wholly. Living intensely liberates one from the burden of unfinished actions and memories, allowing pure presence in the celebration of the present moment."),
        array('name' => 'Card 64', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-13-Sharing.jpg', 'description' => 'The more you share, the more you will have. In the ordinary economics you share and you lose; in the spiritual economics you share and you get more.','ldescription' =>"In spiritual economics, sharing enriches rather than depletes. Unlike in ordinary economics where sharing equals loss, giving in spiritual terms leads to abundance. A humorous tale illustrates this: a beggar warns a generous man of future destitution due to his generosity. Yet, by giving love, joy, and sharing oneself, one experiences an increase, not a decrease. Trust your experience over conventional wisdom; giving wholly and without reservation ultimately leads to greater wealth and fulfillment."),
        array('name' => 'Card 65', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-14-The-Creator.jpg', 'description' => 'The creator’s joy is in creation itself; there is no other reward.','ldescription' =>"The essence of true joy lies in creation itself, without expectation of reward. Creativity, regardless of form, enriches life and elevates existence. To blossom fully, one must embrace solitude and venture into the depths of individual expression. Nijinsky's dance transcended ego, echoing mystic experiences. True creators shun ambition and fame, dedicating themselves solely to their craft. They remain humble, seeing themselves as vessels for divine creativity. Unlike mediocrity's thirst for recognition, genuine creators find fulfillment in the act of creation alone, leaving behind a legacy not of names but of timeless beauty."),
        array('name' => 'Card 66', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-01-Maturity.jpg', 'description' => 'Maturity has nothing to do with your life experiences. It has something to do with your inward journey, experiences of the inner.','ldescription' =>"Maturity transcends worldly experiences, rooted instead in the inward journey. Deep introspection leads to true maturity, where the self dissolves into silence, leaving only presence and innocence. Realization blossoms into love, infusing every action with its fragrance. Western definitions focus on worldly wisdom and toughness, but true maturity is vulnerability, simplicity, and spiritual growth."),
        array('name' => 'Card 67', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-02-Moment-To-Moment.jpg', 'description' => 'The mind cannot trust the moment; it is always afraid; that’s why it plans. It is fear that plans, and by planning you miss everything—everything that is beautiful and true, everything that is divine, you miss.','ldescription' =>"Planning arises from fear of the unknown, obstructing the beauty of life's spontaneity. Heraclitus's wisdom emphasizes life's ever-changing nature. Each moment brings new perspectives; even the sun evolves daily. Trust in spontaneity, embrace change, and reject rigid plans. Planning breeds false encounters, stifling authenticity. Be present, let life unfold naturally, and cherish its beauty and truth. Trust in the moment's infinite possibilities, avoiding the trap of preconceived notions."),
        array('name' => 'Card 68', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-03-Guidance.jpg', 'description' => 'We have lost contact with the inner guide. Everyone is born with that inner guide but it is not allowed to work, to function. It is almost paralyzed. But it can be revived.','ldescription' =>"The inner guide, inherent in all, is often stifled by overreliance on the mind. Zen teaches being moment-to-moment, bypassing thought and trusting intuition. Initially challenging, it requires distinguishing inner guidance from surface thoughts. Relaxation facilitates its emergence, aiding in problem-solving and creativity. Famous discoveries, like Madame Curie's, arose from this intuitive realm. Exhausting the intellect precedes insights, highlighting the inner guide's significance. Embrace the inner guide's wisdom by relinquishing mental dominance. Through stillness, allow its voice to surface, guiding actions with clarity and spontaneity. Trusting this inner wisdom leads to profound discoveries and solutions."),
        array('name' => 'Card 69', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-04-The-Miser.jpg', 'description' => 'Generosity is the real richness.','ldescription' =>"Generosity is true wealth. Riches trap one in a cycle of accumulation, leaving them perpetually poor in spirit. True wealth emerges when one transcends material cravings and embraces sharing. Even the poorest can be generous, offering smiles, warmth, and laughter. Miserliness breeds isolation, while generosity bridges distances and fosters connections. It's not about what one possesses but about sharing one's essence with others. A smile, a song, or a kind gesture holds immeasurable value. Through simple acts of sharing, one discovers the boundless richness within."),
        array('name' => 'Card 70', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-05-The-Outsider.jpg', 'description' => 'The moment you enter to the center of your being, you are no longer an outsider. For the first time you are the insider.','ldescription' =>"Entering the core of your being transforms you from an outsider to an insider. Without this connection to the whole, everyone remains estranged, even amidst relationships. To truly belong, one must commune with the divine, bridging the gap between self and universe. Embracing aloneness as a sacred space brings freedom and joy. Like a lone bird's song, celebrate solitude as a dance of awareness, a fragrance released unaddressed—a communion with existence beyond belonging."),
        array('name' => 'Card 71', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-06-Compromise.jpg', 'description' => 'Compromise is ugly … . How can truth compromise with lies?','ldescription' =>"Compromise distorts truth. Religions divide existence into good and evil, creating hypocrisy. To find authenticity, forge your unique path. Religions lead to conformity; true spirituality makes you a lion, not a sheep. Remain vigilant in the crowd, for it suffocates individuality. You're born into society, but your destiny is yours alone. Inner exploration unveils a boundless sky, where you navigate without footprints. Your journey is singular, leading to bliss and fulfillment. Be the flower that blooms its own path, for paradise lies in individuality, not conformity."),
        array('name' => 'Card 72', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-07-Patience.jpg', 'description' => 'When people start working towards the inner, impatience is the greatest barrier. Infinite patience is needed. It can happen the next moment, but infinite patience is needed.','ldescription' =>"Impatience obstructs inner growth. Infinite patience is essential. Hurry slowly, awaiting the unseen. Inner attunement requires patience. The realm beyond time and space demands infinite patience. Expectations hinder enlightenment. Patience is active, alert, and expectant. Like awaiting a friend, it's radiant, not dull. Nature unfolds in its time; patience quickens it. Urgency breeds confusion; patience fosters peace. Unlearn the rush, embrace grace. Meditation transcends technology, requiring only the present moment."),
        array('name' => 'Card 73', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-08-Ordinariness.jpg', 'description' => 'The discovered self knows nothing of the abnormal, perverted, neurotic mind. It becomes simple, it becomes ordinary, but that ordinariness is luminous.','ldescription' =>"The enlightened self transcends neurotic complexities, embracing simplicity. Ordinary becomes luminous in humility. A tale illustrates humility's depth: a beggar's genuine self-effacement confounds a king and priest. True spirituality lies in being not just ordinary but nobodies, devoid of ego. Zen wisdom illustrates: enlightenment transforms mundane tasks into joyous expressions. Ordinary life, when sanctified, unveils true bliss. Ego resists ordinariness, craving extraordinariness, yet simplicity leads to inner sovereignty. Embracing nothingness births the enlightened emperor within, where joy knows no bounds."),
        array('name' => 'Card 74', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-09-Ripeness.jpg', 'description' => 'The only ripeness that is possible is through living.','ldescription' =>"Embrace living fully to attain true ripeness. Enjoy each moment with vigor to cultivate wisdom and readiness for death's embrace. By immersing in life's beauty, death becomes a natural culmination, not an obsession. Seeking eventually dissolves into blissful rest, but rushing the process is futile. Allow seeking to mature naturally, like a ripening fruit, until it falls ripe and ready."),
        array('name' => 'Card 75', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-10-We-Are-The-World.jpg', 'description' => 'Once you understand yourself, you have understood the whole humanity. In that very understanding a great vision arises in which we are all brothers and sisters and we are all in the same boat.','ldescription' =>"Understanding oneself reveals the interconnectedness of humanity. Walls dissolve as boundaries blur—we breathe each other's breath, pour into one another's lives. Acceptance leads to revolution, seeing all as friends, brothers, and sisters. In this shared boat of existence, fear and nervousness vanish, replaced by a global celebration of life. War becomes inconceivable amidst the festivity of millions embracing divinity. Life isn't for destruction but creation, rejoicing, and celebration, where every tear transforms into a dance, echoing through eternity."),
        array('name' => 'Card 76', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-11-Adventure.jpg', 'description' => 'Life is an adventure. Invite constant adventures, and whenever a call comes from the unknown, listen to it. Risk all and go into the unknown, because this is the only way to live at the maximum.','ldescription' =>"Embrace life as an adventure, heeding the call of the unknown. Fearlessly venture beyond the confines of the mind, shedding the past to live each moment fully. Adventure brings joy and ecstasy, while security breeds comfort in lies. Skill offers security but lacks adventure; true living lies in embracing insecurity and novelty. Cherish old friendships or revel in the thrill of new connections. Life's dichotomy offers either security or adventure; both cannot coexist. To live fully is to embrace the unknown, risking all for the thrill of the journey."),
        array('name' => 'Card 77', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-12-Slowing Down.jpg', 'description' => 'Slow down all the processes that you do. If you are walking, walk slowly—there is no hurry. If you are eating, eat slowly. If you are talking, talk slowly. Slow down all the processes, and you will see that you can become silent very easily.','ldescription' =>"By slowing down daily activities, one can cultivate inner silence and peace. Rushing leads to stress and anxiety, with no true purpose. A Taoist tale illustrates the folly of valuing speed over simplicity. Inventions may save time, but without peace, what use is saved time? Slowing down eating, talking, and embracing moments of idleness fosters a sense of ease and contentment. Taking time to sit in silence daily allows peace to emerge, revealing the essence of life. Peace, not haste, brings fulfillment and meaning to existence."),
       array('name' => 'Card 78', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-13-Flowering.jpg', 'description' => 'This world needs only one experience: a purity, uncontaminated, unpolluted even by the presence of anybody else. A pure presence of your own being—to me, that is the liberation. To me, that is the ultimate flowering of your being.','ldescription' =>"True liberation is found in experiencing the purity of one's own being, untouched by external influences. Like the vibrant colors of spring, inner bliss blossoms freely when one embraces joy in ordinary moments. Omar Khayyam's message, often misunderstood, emphasizes finding joy in the simple things of life as a path to spiritual growth. Learning to enjoy even the seemingly mundane cultivates gratitude and transforms the ordinary into the sacred. By cherishing each moment, one prepares the heart for the profound experience of existence's light."),
       array('name' => 'Card 79', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-14-Abundance.jpg', 'description' => 'One thing is certain: Existence is overflowing. With everything it is luxurious. It is not a poor existence, no. Poverty is man’s creation.','ldescription' =>"Existence is abundant, not poor; poverty is a human construct. Life overflows with richness and abundance, seen in countless flowers and stars. Many exist but never truly live, missing out on love, joy, and ecstasy. True richness lies in experiencing the multifaceted beauty of life: music, art, nature's wonders. Living fully means embracing life's luxuries—its music, poetry, painting, and sculpture."),

        // Add more cards as needed
    );
foreach ($cards as $card) {
    foreach ($card as $key => $value) {
        $encoding = mb_detect_encoding($value);
        error_log("The encoding of the $key field is: $encoding");
    }
}


global $wpdb;
$wpdb->set_charset($wpdb->dbh, 'utf8mb4');

$table_name = $wpdb->prefix . 'cards';


foreach ($cards as $card) {
    // Explicitly check and convert to UTF-8 if necessary
    foreach ($card as $key => $value) {
        $card[$key] = convert_to_ascii($value);


    }

    // Sanitize and prepare data
    $data = array(
        'name' => sanitize_text_field($card['name']),
        'icon' => esc_url_raw($card['icon']),
        'description' => wp_kses_post($card['description']),
        'ldescription' => isset($card['ldescription']) ? wp_kses_post($card['ldescription']) : ''
    );

    // Insert the card into the database, check for false to catch errors
    $result = $wpdb->insert($table_name, $data);
    if ($result === false) {
        // Handle the error, e.g., log or echo an error message
        // This is just a placeholder for error handling
        echo "An error occurred while inserting: " . $wpdb->last_error;
    }
}


}
function convert_to_ascii($string) {
    // Mapping of special characters to ASCII equivalents
    $special_chars_mapping = array(
        '’' => "'", // Right single quotation mark
        '“' => '"', // Left double quotation mark
        '”' => '"', // Right double quotation mark
        '…' => '...', // Ellipsis
        '—' => '-', // Em dash
        // Add more mappings as needed
    );

    // Replace special characters with their ASCII equivalents
    $ascii_string = str_replace(array_keys($special_chars_mapping), array_values($special_chars_mapping), $string);

    // Optionally, remove any remaining non-ASCII characters
    $ascii_string = preg_replace('/[^\x20-\x7E]/', '', $ascii_string);

    return $ascii_string;
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-card-deactivator.php
 */
function deactivate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-deactivator.php';
	Card_Deactivator::deactivate();
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

register_activation_hook( __FILE__, 'activate_card' );
register_deactivation_hook( __FILE__, 'deactivate_card' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-card.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function display_cards() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id ASC"); // Assuming you want them ordered by ID

    ob_start();

    // Start of the container
    echo '<div class="cards-container">';

    if ($cards) {
        foreach ($cards as $card) {
            echo '<div class="card" data-id="' . esc_attr($card->id) . '" >';
            echo '<div class="front" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back">';
            echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>'; // Close .card
        }
    } else {
        echo 'No cards found.';
    }

    // Navigation buttons outside the loop
    echo '<div class="card-navigation-buttons1">';
    echo '<button class="prev-button1">Previous</button>';
    echo '<button class="next-button1">Next</button>';
    echo '</div>';

    // End of the container
    echo '</div>';

    return ob_get_clean();
}



add_shortcode('display_cards', 'display_cards');

function display_cards_in_sets() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Fetch all cards
    $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY RAND()");

    // Shuffle the cards and divide into three sets
    shuffle($cards);
    $sets = array_chunk($cards, ceil(count($cards) / 3));

    ob_start();

    // Display the sets
    foreach ($sets as $index => $set) {
        echo '<div class="card-set-container">'; // Container for the set and navigation buttons
        echo '<div class="card-set" id="set-' . $index . '" style="display: flex; flex-direction: row; justify-content: center;">';
        
        // Inside your foreach loop for each card
        $cardIndex = 0; // Initialize a counter for each card
        foreach ($set as $card) {
            echo '<div class="card1" data-id="' . esc_attr($card->id) . '" style="margin: 5px; --i: ' . $cardIndex++ . ';">';
            echo '<div class="front1">';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back1" style="margin: 5px;">';
            echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>'; // Close .card1
        }
        
        echo '</div>'; // Close .card-set

        // Navigation buttons for each set
        echo '<div class="card-navigation-buttons">';
        echo '<button class="prev-button" data-set="' . $index . '">Previous</button>';
        echo '<button class="next-button" data-set="' . $index . '">Next</button>';
        echo '</div>';

        echo '</div>'; // Close .card-set-container
    }

    return ob_get_clean();
}

// Register the function as a shortcode to use it easily within WordPress
add_shortcode('display_cards_in_sets', 'display_cards_in_sets');


function picked_card() {
     if (!defined('DOING_AJAX') || !DOING_AJAX) {
        error_log('Not doing AJAX');
        return;
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Initialize an empty array to hold the cards
    $cards = [];

    if (isset($_POST['pick-seven-cards-button']) && $_POST['pick-seven-cards-button'] == true) {
        if (!is_user_logged_in()) {
            echo 'You must be logged in to pick cards.';
            wp_die();
        }
        // Fetch a custom number of random cards if the user is an administrator
        $num_cards = 7; // default number of cards
        if (current_user_can('administrator') && isset($_POST['num_cards'])) {
            $num_cards = intval($_POST['num_cards']);
            error_log('Number of cards to pick: ' . $num_cards); // Log the number of cards
        }
error_log('Executing SQL query with num_cards: ' . $num_cards); // Log the number of cards

        error_log('User role: ' . (current_user_can('administrator') ? 'Administrator' : 'Not Administrator'));
        error_log('POST data: ' . print_r($_POST, true));

        $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY RAND() LIMIT $num_cards");
    } else {
        if (!isset($_POST['card_id'])) {
            error_log('No card ID in POST data');
            echo 'No card picked yet.';
            wp_die();
        }
        $card_id = intval($_POST['card_id']);
        // Fetch the specific card by ID
        $card = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $card_id));
        if ($card) {
            $cards[] = $card; // Add the single card to the cards array for consistent processing
        }
    }


    ob_start();

    if (!empty($cards)) {
        foreach ($cards as $card) {
            echo '<div class="picked-card" data-id="' . esc_attr($card->id) . '">';
            echo '<button class="remove-card">X</button>';
            echo '<div class="front" style="margin: 5px;" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back">';
echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>';
        }
    } else {
        error_log('No card found');
        echo 'No card found.';
    }

    echo ob_get_clean();
    wp_die();
}


add_action('wp_ajax_picked_card', 'picked_card');
add_action('wp_ajax_nopriv_picked_card', 'picked_card');



function enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-dialog'); // Add this line
        wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__). '/js/ajax.js', array('jquery'), '1.0', true);

    wp_enqueue_script('card-shuffle', plugin_dir_url(__FILE__) . 'js/card-shuffle.js', array('jquery', 'jquery-ui-dialog'), '1.0', true); // Add 'jquery-ui-dialog' to the dependencies array
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'is_admin' => current_user_can('administrator') ? 'yes' : 'no','is_user_logged_in' => is_user_logged_in() ? 'yes' : 'no') );
        wp_enqueue_script('my-plugin-show-cards', plugin_dir_url(__FILE__) . 'js/show-cards.js', array('jquery'), null, true);
    wp_localize_script('my-plugin-show-cards', 'ajaxurl', admin_url('admin-ajax.php'));

    // Pass the AJAX URL to script.js
    wp_localize_script('card-shuffle', 'card_shuffle', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');


// Create an AJAX endpoint for shuffling cards
add_action( 'wp_ajax_card_shuffle', 'card_shuffle_callback' );
add_action( 'wp_ajax_nopriv_card_shuffle', 'card_shuffle_callback' );

function display_cards_in_sets_ajax() {
    echo do_shortcode('[display_cards_in_sets]');
    wp_die(); // This is required to terminate immediately and return a proper response
}

add_action('wp_ajax_display_cards_in_sets_ajax', 'display_cards_in_sets_ajax');
add_action('wp_ajax_nopriv_display_cards_in_sets_ajax', 'display_cards_in_sets_ajax');

add_action('admin_menu', 'error_log_menu');

function error_log_menu() {
    add_options_page(
        'Error Log', // Page title
        'Error Log', // Menu title
        'manage_options', // Capability
        'error-log', // Menu slug
        'error_log_page' // Function that handles the page content
    );
}

function error_log_page() {
    $log_path = ini_get('error_log'); // Get the path of the error log

    echo '<div class="wrap">';
    echo '<h1>Error Log</h1>';
    echo '<p>The error logs are stored at: ' . $log_path . '</p>';
    echo '</div>';
}


function card_shuffle_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Logging the POST data
    error_log('POST data: ' . print_r($_POST, true));

    $picked_card_ids = isset($_POST['picked_card_ids']) ? array_map('intval', $_POST['picked_card_ids']) : array();

    // Log the picked card IDs
    error_log('Picked card IDs: ' . implode(', ', $picked_card_ids));

    if (!empty($picked_card_ids)) {
        $ids_format = implode(',', array_fill(0, count($picked_card_ids), '%d'));
        $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id IN ($ids_format) ORDER BY RAND() LIMIT 3", $picked_card_ids);
        $cards = $wpdb->get_results($query);

        // Log the query to check if it's correct
        error_log('SQL Query: ' . $wpdb->last_query);
    } else {
        $cards = array(); // If no cards are picked, set to an empty array
        error_log('No picked card IDs provided.');
    }

    if ($cards) {
        foreach ($cards as $card) {
            // Include card ID in the div for the shuffled card
            echo '<div class="shuffled-card" data-card-id="' . esc_attr($card->id) . '">';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '<p>' . esc_html($card->description) . '</p>';
            echo '</div>';
        }
	echo '<input type="email" id="user-email" placeholder="Enter your email" />';

    } else {
        echo 'No cards found.';
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}

function send_cards_to_email() {
    $email_address = $_POST['email'];
    $card_ids = isset($_POST['card_ids']) ? $_POST['card_ids'] : [];

    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Fetch specific cards by IDs
    $cards = $wpdb->get_results("SELECT * FROM $table_name WHERE id IN (" . implode(',', array_map('intval', $card_ids)) . ")");

 $message = '';
    $openai_responses = '';

    if ($cards) {
        // Initialize OpenAI message
$openai_input = "These are 3 cards descriptions I'm sending you. They are all related to psychology and emotions.(tarrot cards) Make a very detailed description about who this person is not more than 300 chars. ";
        foreach ($cards as $card) {
            // Concatenate descriptions for OpenAI input
            $openai_input .= $card->ldescription . ' ';
                        error_log('Added card description: ' . $card->ldescription); // Log each card description


            // Build the email message with card details
            $message .= '<div class="shuffled-card">';
            $message .= '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '" style="width:100px;height:auto;">';
            $message .= '<h3>' . esc_html($card->name) . '</h3>';
            $message .= '<p>' . esc_html($card->description) . '</p>';
            $message .= '</div>';
        }
                error_log('Final OpenAI input: ' . $openai_input);

        // Call OpenAI API with the concatenated ldescriptions
        $openai_api_key = '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';
       $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
    'headers' => array(
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $openai_api_key,
    ),
    'body' => json_encode(array(
        'model' => 'gpt-3.5-turbo', // Use the chat model
        'messages' => array(
            array('role' => 'system', 'content' => 'You are a helpful assistant.'),
            array('role' => 'user', 'content' => $openai_input)
        )
    )),
        'timeout' => 15, // Increase timeout to 15 seconds

));


        if (is_wp_error($response)) {
            error_log('OpenAI API Error: ' . $response->get_error_message());
        } else {
            $http_code = wp_remote_retrieve_response_code($response);
            error_log('OpenAI API Response Code: ' . $http_code);
            
            if ($http_code === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
    $openai_responses = $body['choices'][0]['message']['content']; // Corrected line

                // Log the OpenAI response
                error_log('OpenAI Response: ' . $openai_responses);
            } else {
                error_log('OpenAI API Unexpected Response: ' . wp_remote_retrieve_body($response));
            }
        }

        // Include OpenAI's response in the email message
        $message .= '<div class="openai-response">';
        $message .= '<h3>Insights from OpenAI:</h3>';
        $message .= '<p>' . esc_html($openai_responses) . '</p>';
        $message .= '</div>';

        $message .= '</body></html>';
    } else {
       $message = 'No cards found.';
        error_log('No cards found for provided IDs.');
    }

    // Set content-type header for HTML email
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Use WordPress function to send email
    wp_mail($email_address, 'Shuffled cards', $message, $headers);
 $admin_email_address = get_option('admin_email');

    // Send email to the owner (admin)
    wp_mail($admin_email_address, $subject, $message, $headers);

    wp_die(); // End AJAX request properly
}
add_action('wp_ajax_send_cards_to_email', 'send_cards_to_email');
add_action('wp_ajax_nopriv_send_cards_to_email', 'send_cards_to_email');

function enqueue_styles() {
    wp_enqueue_style('card-layout', plugin_dir_url(__FILE__) . 'css/card-layout.css');
        wp_enqueue_style('my-plugin-styles', plugin_dir_url(__FILE__) . 'css/pileset-style.css');
                wp_enqueue_style('my_card_shuffle', plugin_dir_url(__FILE__) . 'css/card-shuffle.css');


}

add_action('wp_enqueue_scripts', 'enqueue_styles');
function add_custom_style() {
    wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/custom-style.css');
}
add_action('wp_enqueue_scripts', 'add_custom_style');

function run_card() {

	$plugin = new Card();
	$plugin->run();
}
run_card();
