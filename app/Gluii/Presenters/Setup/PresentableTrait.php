<?php namespace App\Gluii\Presenters\Setup;

use App\Gluii\Presenters\Setup\Exceptions\PresenterException;

trait PresentableTrait {

	/**
	 * View presenter namespace
	 *
	 * @var mixed
	 */
	protected $presenterNamespace = 'App\\Gluii\\Presenters\\';

	/**
	 * View presenter instance
	 *
	 * @var mixed
	 */
	protected $presenterInstance;

	/**
	 * Prepare a new or cached presenter instance
	 *
	 * @return mixed
	 * @throws PresenterException
	 */
	public function present()
	{
		if(! $this->presenter)
		{
			$this->presenter = $this->presenterNamespace . class_basename(get_class($this)) . 'Presenter';
		}

		if(! class_exists($this->presenter))
		{
			throw new PresenterException('Presenter Not Found : ' . $this->presenter);
		}

		if(! $this->presenterInstance)
		{
			$this->presenterInstance = new $this->presenter($this);
		}

		return $this->presenterInstance;
	}

}