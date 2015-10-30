<?php

namespace EzSystems\ExtendingPlatformUIConferenceBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller as BaseController;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class ListController extends BaseController
{
    private $searchService;

    private $contentTypeService;

    public function __construct(SearchService $searchService, ContentTypeService $contentTypeService)
    {
        $this->searchService = $searchService;
        $this->contentTypeService = $contentTypeService;
    }

    public function listAction($offset, $typeIdentifier)
    {
        $typesByGroup = [];
        $groups = $this->contentTypeService->loadContentTypeGroups();
        foreach($groups as $group) {
            $typesByGroup[$group->identifier] = $this->contentTypeService->loadContentTypes($group);
        }

        $limit = 10;
        $query = new LocationQuery();
        if ( $typeIdentifier ) {
            $query->query = new Criterion\ContentTypeIdentifier($typeIdentifier);
        } else {
            $query->query = new Criterion\Subtree('/1/');
        }
        $query->offset = (int)$offset;
        $query->limit = $limit;
        $results = $this->searchService->findLocations($query);

        $previous = false;
        $next = false;
        if ( $offset > 0 ) {
            $previous = max(0, $offset - $limit);
        }
        if ( ($offset + $limit) < $results->totalCount ) {
            $next = $offset + $limit;
        }
        return $this->render('EzSystemsExtendingPlatformUIConferenceBundle:List:list.html.twig', [
            'groups' => $groups,
            'typesByGroup' => $typesByGroup,
            'typeIdentifier' => $typeIdentifier,
            'results' => $results,
            'previous' => $previous,
            'next' => $next,
        ]);
    }

}
