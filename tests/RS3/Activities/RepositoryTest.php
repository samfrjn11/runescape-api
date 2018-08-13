<?php

namespace Tests\RS3\Activities;

use PHPUnit\Framework\TestCase;
use RuneStat\RS3\Activities\Activity;
use RuneStat\RS3\Activities\Repository;

class RepositoryTest extends TestCase
{
    /** @test */
    public function it_should_instantiate()
    {
        $repository = new Repository([
            new Activity(
                new \DateTime(),
                'I killed 3 boss monsters in Daemonheim.',
                'I killed 3 boss monsters   called:  a sagittare and Night-gazer Khighorahk   in Daemonheim.'
            ),
        ]);

        $this->assertInstanceOf(Repository::class, $repository);
    }

    /** @test */
    public function it_should_instantiate_from_the_profile_json()
    {
        $json = '[{"date":"12-Aug-2018 21:25","details":"I have uncovered volume 15 of Daemonheim\'s history. I now have 14 volumes in total.","text":"Daemonheim\'s history uncovered, 14 volumes found."},{"date":"12-Aug-2018 21:16","details":"I killed a boss monster   called:  a rammernaut    in Daemonheim.","text":"I killed a boss monster in Daemonheim."},{"date":"12-Aug-2018 20:26","details":"I killed 3 boss monsters   called:  a sagittare and Night-gazer Khighorahk   in Daemonheim.","text":"I killed 3 boss monsters in Daemonheim."},{"date":"12-Aug-2018 20:24","details":"I have uncovered volume 14 of Daemonheim\'s history. I now have 13 volumes in total.","text":"Daemonheim\'s history uncovered, 13 volumes found."},{"date":"11-Aug-2018 20:05","details":"By levelling up my Invention skill, I achieved at least level 31 in all skills.","text":"Levelled all skills over 31"},{"date":"11-Aug-2018 20:05","details":"I levelled my  Invention skill, I am now level 31.","text":"Levelled up Invention."},{"date":"11-Aug-2018 18:56","details":"I levelled my  Construction skill, I am now level 96.","text":"Levelled up Construction."},{"date":"11-Aug-2018 13:30","details":"I killed a boss monster   called:  Stomp    in Daemonheim.","text":"I killed a boss monster in Daemonheim."},{"date":"10-Aug-2018 20:40","details":"I have capped at my Clan Citadel this week.","text":"Capped at my Clan Citadel."},{"date":"09-Aug-2018 22:38","details":"I have visited my Clan Citadel this week.","text":"Visited my Clan Citadel."},{"date":"09-Aug-2018 22:38","details":"I have maintained Fealty rank 3 with my clan.","text":"Maintained Clan Fealty 3"},{"date":"09-Aug-2018 19:47","details":"I now have at least 22000000 experience points in the Thieving skill.","text":"22000000XP in Thieving"},{"date":"09-Aug-2018 08:03","details":"I levelled my  Farming skill, I am now level 97.","text":"Levelled up Farming."},{"date":"08-Aug-2018 07:54","details":"I killed 11 boss monsters   called:  a bulwark beast , Har\'Lakk the Riftsplitter , a sagittare and a rammernaut in Daemonheim.","text":"I killed 11 boss monsters in Daemonheim."},{"date":"08-Aug-2018 07:54","details":"I have uncovered volume 12 of Daemonheim\'s history. I now have 12 volumes in total.","text":"Daemonheim\'s history uncovered, 12 volumes found."},{"date":"08-Aug-2018 07:46","details":"I have uncovered volume 11 of Daemonheim\'s history. I now have 11 volumes in total.","text":"Daemonheim\'s history uncovered, 11 volumes found."},{"date":"08-Aug-2018 07:25","details":"I have uncovered volume 9 of Daemonheim\'s history. I now have 10 volumes in total.","text":"Daemonheim\'s history uncovered, 10 volumes found."},{"date":"08-Aug-2018 07:19","details":"I have uncovered volume 8 of Daemonheim\'s history. I now have 9 volumes in total.","text":"Daemonheim\'s history uncovered, 9 volumes found."},{"date":"07-Aug-2018 22:53","details":"I levelled my  Dungeoneering skill, I am now level 111.","text":"Levelled up Dungeoneering."},{"date":"07-Aug-2018 22:49","details":"I killed 8 boss monsters   called:  a runebound behemoth , a necrolord , Hobgoblin Geomancer and Flesh-spoiler Haasghenahk in Daemonheim.","text":"I killed 8 boss monsters in Daemonheim."}]';

        $repository = Repository::fromProfileJson(
            json_decode($json, true)
        );

        $this->assertInstanceOf(Repository::class, $repository);
    }

    /** @test */
    public function it_should_return_activities()
    {
        $repository = new Repository([
            new Activity(
                new \DateTime(),
                'I killed 3 boss monsters in Daemonheim.',
                'I killed 3 boss monsters   called:  a sagittare and Night-gazer Khighorahk   in Daemonheim.'
            ),
            new Activity(
                new \DateTime(),
                'Levelled up Construction.',
                'I levelled my  Construction skill, I am now level 96.'
            )
        ]);

        $this->assertSame('I killed 3 boss monsters in Daemonheim.', $repository->getActivities()[0]->getText());
        $this->assertSame('Levelled up Construction.', $repository->getActivities()[1]->getText());
    }
}
