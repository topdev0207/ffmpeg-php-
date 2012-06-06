<?php

namespace FFMpeg\Format\Video;

use FFMpeg\Format\Dimension;
use FFMpeg\Format\Video as BaseVideo;
use FFMpeg\Format\Video\Resizable;
use FFMpeg\Format\Video\Transcodable;
use FFMpeg\Format\Video\Resamplable;

/**
 * Common use for 3G mobile phones
 * @see https://wikipedia.org/wiki/3GP_and_3G2
 *
 * Extension/Format for 3GP:
 * 3gp, 3g2
 *
 * Frame size/Resolution settings of 3GP:
 * 80*60, 96*72, 128*96, 160*120, 176*96, 176*120, 176*144, 192*144, 208*160,
 * 240*176, 240*180, 288*224, 320*176, 320*180, 320*192, 320*240, 352*240, 352*288,
 * 368*208, 384*160, 480*368, 640*360, 640*420, 640*480, 704*576, 720*432, 720*480.
 *
 * 3GP Video Compression/CODEC:
 * H.263, H.263+, MPEG-4, H.264.
 *
 * 3GP Video Bit Rate:
 * 32k, 40k, 60k, 64k, 80k, 96k, 104k, 128k, 160k, 240k, 256k.
 *
 * 3GP Video Frame Rate:
 * 10, 12, 15, 20, 24, 25(PAL).
 *
 * 3GP Audio Format/Compression:
 * MPEG2/4 AAC-LC, AMR NB.
 *
 * 3GP Audio Bit Rate settings:
 * 4.75k, 5.15k, 5.9k, 6.7k, 7.4k, 7.95k, 8k, 10.2k, 12k, 16k, 48k, 56k, 64k,
 * 96k, 112k, 128k, 160k, 192k, 224k, 256k, 320k.
 *
 * Audio Frequency/Sampling rate for 3GP:
 * 8000, 11025(low), 12000, 16000, 22050, 24000, 32000, 44100(normal), 48000(high).
 */
class ThreeGP implements BaseVideo, Resizable, Transcodable, Resamplable
{
    /**
     * Width of the video
     * @var int
     */
    protected $width = 176;

    /**
     * Height of the video
     * @var int
     */
    protected $height = 144;

    /**
     * Binary flow of the encoded video
     * @var int
     */
    protected $kiloBitrate = 240;

    /**
     * Audio sample frequency
     * @var int
     */
    protected $audioSampleRate = 8000;

    /**
     * Video codec
     * @var string
     */
    protected $videoCodec = 'h263';

    /**
     * Audi codec
     * @var string
     */
    protected $audioCodec = 'aac';

    /**
     * Video frameRate
     * @var int
     */
    protected $frameRate = 12;

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
        
        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function getKiloBitrate()
    {
        return $this->kiloBitrate;
    }

    public function getExtraParams()
    {
        return '-f 3gp';
    }

    public function getAudioSampleRate()
    {
        return $this->audioSampleRate;
    }

    public function getComputedDimensions($originalWidth, $originalHeight)
    {
        return new Dimension($this->width, $this->height);
    }

    public function getVideoCodec()
    {
        return $this->videoCodec;
    }

    public function getAudioCodec()
    {
        return $this->audioCodec;
    }

    public function getAvailableVideoCodecs()
    {
        return array('h263', 'h264');
    }

    public function getAvailableAudioCodecs()
    {
        return array('aac', 'amr');
    }

    public function getFrameRate()
    {
        return $this->frameRate;
    }

    public function setKiloBitrate($kiloBitrate)
    {
        $this->kiloBitrate = $kiloBitrate;

        return $this;
    }

    public function setAudioSampleRate($audioSampleRate)
    {
        $this->audioSampleRate = $audioSampleRate;

        return $this;
    }

    public function setFrameRate($frameRate)
    {
        $this->frameRate = $frameRate;

        return $this;
    }

    public function setVideoCodec($videoCodec)
    {
        if (in_array($videoCodec, $this->getAvailableVideoCodecs())) {
            $this->videoCodec = $videoCodec;
        }

        return $this;
    }

    public function setAudioCodec($audioCodec)
    {
        if (in_array($audioCodec, $this->getAudioCodec())) {
            $this->audioCodec = $audioCodec;
        }

        return $this;
    }

    public function getGOPSize()
    {
        return 0;
    }

    public function supportBFrames()
    {
        return false;
    }
}
